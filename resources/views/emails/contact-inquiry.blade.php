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
  .badge {
    display: inline-block;
    background: #eef4fa;
    color: #2d6fa3;
    font-size: 12px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 999px;
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
    width: 32%;
    color: #475569;
  }
  .value {
    color: #020617;
    font-weight: 700;
  }
  .message-box {
    background: #f8fafc;
    border: 1px solid #e8edf4;
    border-radius: 6px;
    padding: 14px 16px;
    color: #0f172a;
    font-size: 14px;
    line-height: 1.65;
    white-space: pre-line;
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

<div class="card">
  <div class="header">
    <p class="brand">Krousar Thmey — Website Contact Form</p>
    <h1>New message for {{ $data['office_country'] }}</h1>
    <span class="badge">{{ $data['subject'] }}</span>
  </div>

  <div class="body">
    <p>Hello,</p>
    <p>You have received a new enquiry through the Contact page, addressed to the <strong>{{ $data['office_country'] }}</strong> office.</p>

    <table>
      <tr>
        <td class="label">Name</td>
        <td class="value">{{ $data['name'] }}</td>
      </tr>
      <tr>
        <td class="label">Email</td>
        <td class="value"><a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></td>
      </tr>
      @if(!empty($data['organisation']))
      <tr>
        <td class="label">Organisation</td>
        <td class="value">{{ $data['organisation'] }}</td>
      </tr>
      @endif
      <tr>
        <td class="label">Subject</td>
        <td class="value">{{ $data['subject'] }}</td>
      </tr>
      <tr>
        <td class="label">Received</td>
        <td class="value">{{ now()->format('d M Y, H:i') }}</td>
      </tr>
    </table>

    <p style="margin-bottom:8px;"><strong>Message</strong></p>
    <div class="message-box">{{ $data['message'] }}</div>

    <p style="margin-top:22px;">
      <a href="mailto:{{ $data['email'] }}" class="button">Reply to {{ $data['name'] }}</a>
    </p>
  </div>

  <div class="footer">
    Krousar Thmey - Cambodia since 1991<br>
    <a href="{{ url('/') }}">krousar-thmey.org</a> | <a href="mailto:info@krousar-thmey.org">info@krousar-thmey.org</a>
  </div>
</div>
</body>
</html>
