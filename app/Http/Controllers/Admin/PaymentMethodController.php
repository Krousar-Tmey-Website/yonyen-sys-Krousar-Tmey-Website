<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentMethodRequest;
use App\Http\Requests\UpdatePaymentMethodRequest;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PaymentMethodController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $status = $request->query('status');

        $perPage = $request->query('per_page', 10);

        $paymentMethods = PaymentMethod::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($status === 'active', fn ($query) => $query->where('is_active', true))
            ->when($status === 'inactive', fn ($query) => $query->where('is_active', false))
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate($perPage);

        $activeFilters = (filled($search) ? 1 : 0) + (filled($status) ? 1 : 0);

        $viewData = [
            'paymentMethods' => $paymentMethods,
            'filters'        => ['search' => $search, 'status' => $status ?? ''],
            'totalMethods'   => $paymentMethods->total(),
            'activeCount'    => $activeFilters,
        ];

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'html'          => view('admin.payments._results', $viewData)->render(),
                'total'         => $paymentMethods->total(),
                'activeFilters' => $activeFilters,
            ]);
        }

        return view('admin.payments.index', $viewData);
    }

    public function create()
    {
        return view('admin.payments.create');
    }

    public function store(StorePaymentMethodRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('qr_code')) {
            $data['qr_code'] = $request->file('qr_code')->store('payment-qr-codes', 'public');
        } else {
            $data['qr_code'] = null;
        }

        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        // Auto-generate a unique code from the name if not provided
        $data['code'] = $data['code'] ?? $this->generateUniqueCode($data['name']);

        PaymentMethod::create($data);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment method created successfully.');
    }

    public function edit(PaymentMethod $payment)
    {
        return view('admin.payments.edit', ['paymentMethod' => $payment]);
    }

    public function update(UpdatePaymentMethodRequest $request, PaymentMethod $payment)
    {
        $data = $request->validated();

        if ($request->hasFile('qr_code')) {
            if ($payment->qr_code) {
                Storage::disk('public')->delete($payment->qr_code);
            }
            $data['qr_code'] = $request->file('qr_code')->store('payment-qr-codes', 'public');
        } elseif ($request->boolean('remove_qr')) {
            if ($payment->qr_code) {
                Storage::disk('public')->delete($payment->qr_code);
            }
            $data['qr_code'] = null;
        } else {
            unset($data['qr_code']);
        }

        $data['is_active'] = $request->boolean('is_active');

        // Preserve existing code; it's auto-generated on create and not editable
        unset($data['code']);

        $payment->update($data);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment method updated successfully.');
    }

    public function destroy(PaymentMethod $payment)
    {
        if ($payment->qr_code) {
            Storage::disk('public')->delete($payment->qr_code);
        }

        $payment->delete();

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment method removed successfully.');
    }

    /**
     * Auto-generate a unique short code from a payment method name.
     *
     * Examples:
     *   "ABA Bank"       → "ABA"
     *   "ACLEDA Bank"    → "ACLEDA"
     *   "Wing Bank"      → "WING"
     *   "Sathapana Bank" → "SATHAPANA"
     *   "CAB Bank"       → "CAB"
     */
    private function generateUniqueCode(string $name): string
    {
        // Strip common suffixes and clean the name
        $code = strtoupper(Str::of($name)
            ->replace([' Bank', ' Banking', ' Ltd', ' PLC', '.', ','], '')
            ->trim()
            ->toString());

        // Remove special characters, replace with underscore
        $code = preg_replace('/[^A-Z0-9_\-]/', '_', $code);
        $code = trim($code, '_');

        // Limit to column length (50 chars)
        $code = mb_substr($code, 0, 50);

        // Fallback if name produced nothing
        if (empty($code)) {
            $code = 'PM';
        }

        // Ensure uniqueness by appending a suffix if needed
        $original = $code;
        $counter = 1;

        while (PaymentMethod::where('code', $code)->exists()) {
            $suffix = (string) $counter;
            $maxPrefixLen = 50 - strlen($suffix) - 1;
            $code = mb_substr($original, 0, max($maxPrefixLen, 0)) . '_' . $suffix;
            $counter++;
        }

        return $code;
    }
}
