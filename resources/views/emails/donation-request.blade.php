<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  body {
    margin: 0;
    padding: 40px 16px;
    background: #ffffff;
    color: #0f172a;
    font-family: Arial, Helvetica, sans-serif;
  }
  .card {
    max-width: 560px;
    margin: 0 auto;
    background: #ffffff;
    border: 1px solid #dbe3ee;
    border-radius: 8px;
    overflow: hidden;
  }
  .header {
    padding: 28px 28px 20px;
  }
  .brand {
    margin: 0 0 14px;
    color: #2d6fa3;
    font-size: 14px;
    font-weight: 700;
  }
  h1 {
    margin: 0 0 12px;
    color: #020617;
    font-size: 22px;
    line-height: 1.3;
  }
  .amount {
    color: #8da83a;
    font-size: 26px;
    font-weight: 800;
    line-height: 1.2;
  }
  .body {
    padding: 24px 28px;
    border-top: 1px solid #dbe3ee;
  }
  p {
    margin: 0 0 18px;
    color: #0f172a;
    font-size: 14px;
    line-height: 1.65;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin: 12px 0 22px;
  }
  td {
    padding: 12px 0;
    border-bottom: 1px solid #e8edf4;
    color: #0f172a;
    font-size: 14px;
    vertical-align: top;
  }
  .label {
    width: 36%;
    color: #475569;
  }
  .value {
    color: #020617;
    font-weight: 700;
  }
  a {
    color: #1f6fa9;
    font-weight: 700;
  }
  .button {
    display: inline-block;
    background: #2d6fa3;
    color: #ffffff !important;
    text-decoration: none;
    padding: 12px 18px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 700;
  }
  .footer {
    padding: 18px 28px;
    border-top: 1px solid #dbe3ee;
    color: #475569;
    font-size: 12px;
    line-height: 1.6;
  }
</style>
</head>
<body>
@php
  $symbol = match($data['currency']) {
      'EUR' => 'EUR ',
      'KHR' => 'KHR ',
      default => '$',
  };
  $amount = $symbol . number_format($data['amount'], 0);
  $frequency = match($data['frequency']) {
      'monthly' => 'Monthly',
      'annual' => 'Annual',
      default => 'One-time',
  };
@endphp

<div class="card">
  <div class="header">
    <p class="brand">Krousar Thmey</p>
    <h1>{{ $forTeam ? 'New Donation Request' : 'Thank You for Your Donation Request' }}</h1>
    <div class="amount">{{ $amount }} {{ $data['currency'] }}</div>
  </div>

  <div class="body">
    @if($forTeam)
      <p>Hello Krousar Thmey Team,</p>
      <p>A new donation request was submitted from the website. Please contact the donor to arrange payment.</p>

      <table>
        <tr>
          <td class="label">Name</td>
          <td class="value">{{ $data['name'] }}</td>
        </tr>
        <tr>
          <td class="label">Email</td>
          <td class="value"><a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></td>
        </tr>
        @if(!empty($data['phone']))
        <tr>
          <td class="label">Phone / Telegram</td>
          <td class="value">{{ $data['phone'] }}</td>
        </tr>
        @endif
        <tr>
          <td class="label">Amount</td>
          <td class="value">{{ $amount }} {{ $data['currency'] }}</td>
        </tr>
        <tr>
          <td class="label">Frequency</td>
          <td class="value">{{ $frequency }}</td>
        </tr>
        @if(!empty($data['message']))
        <tr>
          <td class="label">Message</td>
          <td class="value" style="font-weight:400">{{ $data['message'] }}</td>
        </tr>
        @endif
        <tr>
          <td class="label">Received</td>
          <td class="value">{{ now()->format('d M Y, H:i') }}</td>
        </tr>
      </table>

      <a href="mailto:{{ $data['email'] }}" class="button">Reply to Donor</a>
    @else
      <p>Dear {{ $data['name'] }},</p>
      <p>Thank you for contacting Krousar Thmey. We have received your donation request and our team will contact you soon to arrange the payment.</p>

      <table>
        <tr>
          <td class="label">Name</td>
          <td class="value">{{ $data['name'] }}</td>
        </tr>
        <tr>
          <td class="label">Amount</td>
          <td class="value">{{ $amount }} {{ $data['currency'] }}</td>
        </tr>
        <tr>
          <td class="label">Frequency</td>
          <td class="value">{{ $frequency }}</td>
        </tr>
        @if(!empty($data['message']))
        <tr>
          <td class="label">Message</td>
          <td class="value" style="font-weight:400">{{ $data['message'] }}</td>
        </tr>
        @endif
      </table>

      <p>Questions? Contact us at <a href="mailto:info@krousar-thmey.org">info@krousar-thmey.org</a>.</p>
    @endif
  </div>

  <div class="footer">
    Krousar Thmey - Cambodia since 1991<br>
    <a href="{{ url('/') }}">krousar-thmey.org</a> | <a href="mailto:info@krousar-thmey.org">info@krousar-thmey.org</a>
  </div>
</div>
</body>
</html>
