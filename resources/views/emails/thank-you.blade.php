<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<style>
  body {
    background: #f8fafc;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    color: #334155;
    margin: 0;
    padding: 40px 20px;
    -webkit-font-smoothing: antialiased;
  }
  .card {
    max-width: 480px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    padding: 36px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
  }
  .brand {
    color: #2d6fa3;
    font-size: 15px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 24px;
  }
  .title {
    font-size: 22px;
    font-weight: 700;
    color: #0f172a;
    margin-top: 0;
    margin-bottom: 12px;
  }
  .greeting {
    font-size: 15px;
    color: #334155;
    margin-bottom: 12px;
  }
  .intro {
    font-size: 14px;
    line-height: 1.6;
    color: #64748b;
    margin-bottom: 24px;
  }
  .receipt-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 24px;
  }
  .receipt-table td {
    padding: 12px 0;
    font-size: 13px;
    border-bottom: 1px solid #f1f5f9;
  }
  .receipt-table tr:last-child td {
    border-bottom: none;
  }
  .label {
    color: #64748b;
    font-weight: 500;
    width: 40%;
  }
  .value {
    color: #0f172a;
    font-weight: 600;
    text-align: right;
  }
  .amount-val {
    color: #8da83a;
    font-size: 14px;
  }
  .footer {
    border-top: 1px solid #f1f5f9;
    padding-top: 20px;
    font-size: 14px;
    color: #64748b;
    line-height: 1.6;
  }
  .signoff {
    margin-top: 24px;
    font-size: 13px;
    color: #94a3b8;
  }
</style>
</head>
<body>
<div class="card">
  <div class="brand">Krousar Thmey</div>
  
  <p class="greeting">Dear {{ $firstName }},</p>
  <p class="intro">
    Thank you for your donation. Your generosity is appreciated! Here are the details of your donation:
  </p>

  @php
    $symbol = match($currency) { 'EUR' => '€', 'KHR' => '៛', default => '$' };
  @endphp
  <table class="receipt-table">
    <tr>
      <td class="label">Donor</td>
      <td class="value">{{ $firstName }} {{ $lastName }}</td>
    </tr>
    <tr>
      <td class="label">Donation Date</td>
      <td class="value">{{ $date }}</td>
    </tr>
    <tr>
      <td class="label">Amount</td>
      <td class="value amount-val">{{ $symbol }}{{ number_format($amount, 2) }} {{ $currency }}</td>
    </tr>
    <tr>
      <td class="label">Card Code</td>
      <td class="value" style="font-family: monospace; font-size: 16px; font-weight: bold;">{{ $cardCode }}</td>
    </tr>
  </table>

  <div class="footer">
    <p>We truly appreciate your kindness and support.</p>
  </div>
  
  <p class="signoff">
    Sincerely,<br>
    <strong>Krousar Thmey Team</strong>
  </p>
</div>
</body>
</html>
