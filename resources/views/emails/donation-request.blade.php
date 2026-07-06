<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<style>
  *{margin:0;padding:0;box-sizing:border-box}
  body{background:#f4f6fb;font-family:'Segoe UI',Arial,sans-serif;color:#333}
  .wrap{max-width:600px;margin:32px auto;background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.08)}
  .header{background:#2d6fa3;padding:36px 40px 28px;text-align:center}
  .header h1{color:#fff;font-size:22px;margin-top:16px;font-weight:700}
  .header p{color:rgba(255,255,255,.75);font-size:14px;margin-top:6px}
  .badge{display:inline-block;background:#8da83a;color:#fff;font-size:28px;font-weight:800;padding:10px 28px;border-radius:999px;margin-top:20px}
  .body{padding:36px 40px}
  .greeting{font-size:17px;color:#2d6fa3;font-weight:600;margin-bottom:16px}
  .text{font-size:14px;line-height:1.7;color:#555;margin-bottom:20px}
  .table{width:100%;border-collapse:collapse;margin-bottom:24px}
  .table td{padding:11px 14px;font-size:13px;border-bottom:1px solid #f0f0f0}
  .table tr:last-child td{border-bottom:none}
  .label{color:#999;width:38%;font-weight:500}
  .value{color:#222;font-weight:600}
  .note{background:#f8f9fc;border-left:4px solid #8da83a;border-radius:8px;padding:16px 20px;font-size:13px;color:#555;line-height:1.6;margin-bottom:24px}
  .btn-wrap{text-align:center;margin:24px 0 8px}
  .btn{display:inline-block;background:#2d6fa3;color:#fff;text-decoration:none;padding:13px 32px;border-radius:999px;font-weight:700;font-size:14px}
  .footer{background:#f8f9fc;padding:20px 40px;text-align:center;font-size:12px;color:#aaa;border-top:1px solid #eee}
  .footer a{color:#2d6fa3;text-decoration:none}
</style>
</head>
<body>
<div class="wrap">

  <div class="header">
    <div style="width:56px;height:56px;border-radius:14px;background:rgba(255,255,255,.15);display:inline-flex;align-items:center;justify-content:center;">
      <span style="color:#fff;font-size:22px;font-weight:900;">KT</span>
    </div>
    <h1>{{ $forTeam ? 'New Donation Request' : 'Thank You for Your Support!' }}</h1>
    <p>{{ $forTeam ? 'A donor has submitted a donation request via the website' : 'Krousar Thmey · New Family · Cambodia' }}</p>
    @php
      $symbol = match($data['currency']) { 'EUR' => '€', 'KHR' => '៛', default => '$' };
      $freq   = match($data['frequency']) { 'monthly' => '/month', 'annual' => '/year', default => '' };
    @endphp
    <div class="badge">{{ $symbol }}{{ number_format($data['amount'], 0) }}{{ $freq }}</div>
  </div>

  <div class="body">
    @if($forTeam)
      <p class="greeting">Hello Krousar Thmey Team,</p>
      <p class="text">A new donation request has been submitted. Please contact the donor to arrange payment.</p>

      <table class="table">
        <tr><td class="label">Name</td>    <td class="value">{{ $data['name'] }}</td></tr>
        <tr><td class="label">Email</td>   <td class="value"><a href="mailto:{{ $data['email'] }}" style="color:#2d6fa3">{{ $data['email'] }}</a></td></tr>
        @if(!empty($data['phone']))
        <tr><td class="label">Phone / Telegram</td><td class="value">{{ $data['phone'] }}</td></tr>
        @endif
        <tr><td class="label">Amount</td>  <td class="value" style="color:#8da83a;font-size:18px">{{ $symbol }}{{ number_format($data['amount'],0) }} {{ $data['currency'] }}</td></tr>
        <tr><td class="label">Frequency</td><td class="value">{{ ucfirst($data['frequency']) }}</td></tr>
        @if(!empty($data['message']))
        <tr><td class="label">Message</td> <td class="value" style="font-weight:400">{{ $data['message'] }}</td></tr>
        @endif
        <tr><td class="label">Received</td><td class="value">{{ now()->format('d M Y, H:i') }}</td></tr>
      </table>

      <div class="btn-wrap">
        <a href="mailto:{{ $data['email'] }}" class="btn">Reply to Donor</a>
      </div>

    @else
      <p class="greeting">Dear {{ $data['name'] }},</p>
      <p class="text">
        Thank you so much for reaching out! We have received your donation request and our team will contact you within <strong>1–2 business days</strong> to arrange the payment.
      </p>

      <table class="table">
        <tr><td class="label">Your Name</td> <td class="value">{{ $data['name'] }}</td></tr>
        <tr><td class="label">Amount</td>    <td class="value" style="color:#8da83a;font-size:18px">{{ $symbol }}{{ number_format($data['amount'],0) }} {{ $data['currency'] }}</td></tr>
        <tr><td class="label">Frequency</td> <td class="value">{{ ucfirst($data['frequency']) }}</td></tr>
        @if(!empty($data['message']))
        <tr><td class="label">Message</td>   <td class="value" style="font-weight:400">{{ $data['message'] }}</td></tr>
        @endif
      </table>

      <div class="note">
        We guarantee that <strong>100% of your donation</strong> goes directly to supporting children in Cambodia — through child welfare, special education for deaf and blind students, and cultural development.
      </div>

      <p class="text">
        Questions? Contact us at <a href="mailto:info@krousar-thmey.org" style="color:#2d6fa3">info@krousar-thmey.org</a>
      </p>

      <div class="btn-wrap">
        <a href="{{ url('/our-programs') }}" class="btn">Learn About Our Programs</a>
      </div>
    @endif
  </div>

  <div class="footer">
    <p style="margin-bottom:6px"><strong style="color:#2d6fa3">Krousar Thmey</strong> · Cambodia since 1991</p>
    <p><a href="{{ url('/') }}">krousar-thmey.org</a> &nbsp;·&nbsp; <a href="mailto:info@krousar-thmey.org">info@krousar-thmey.org</a></p>
    <p style="margin-top:8px;color:#ccc;font-size:11px">Offices in Cambodia · France · Switzerland · Singapore</p>
  </div>

</div>
</body>
</html>
