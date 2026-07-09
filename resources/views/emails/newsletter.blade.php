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
  .header-logo{width:56px;height:56px;border-radius:14px;background:rgba(255,255,255,.15);display:inline-flex;align-items:center;justify-content:center;margin-bottom:12px}
  .header-logo span{color:#fff;font-size:22px;font-weight:900}
  .header h1{color:#fff;font-size:24px;font-weight:700;line-height:1.3}
  .body{padding:36px 40px}
  .greeting{font-size:15px;color:#555;line-height:1.8;margin-bottom:20px}
  .greeting p{margin-bottom:14px}
  .greeting a{color:#2d6fa3}
  .footer{background:#f8f9fc;padding:20px 40px;text-align:center;font-size:12px;color:#aaa;border-top:1px solid #eee}
  .footer a{color:#2d6fa3;text-decoration:none}
  .unsubscribe{color:#aaa;font-size:11px;margin-top:8px}
</style>
</head>
<body>
<div class="wrap">

  <div class="header">
    <div class="header-logo"><span>KT</span></div>
    <h1>{{ $subject }}</h1>
  </div>

  <div class="body">
    <div class="greeting">
      {!! nl2br(e($body)) !!}
    </div>
    <p style="color:#999;font-size:13px;border-top:1px solid #eee;padding-top:20px;margin-top:20px">
      —<br>
      <strong style="color:#2d6fa3">Krousar Thmey</strong><br>
      Cambodia's first organization helping disadvantaged children since 1991
    </p>
  </div>

  <div class="footer">
    <p><strong style="color:#2d6fa3">Krousar Thmey</strong> · Cambodia since 1991</p>
    <p><a href="{{ url('/') }}">krousar-thmey.org</a> &nbsp;·&nbsp; <a href="mailto:info@krousar-thmey.org">info@krousar-thmey.org</a></p>
    <p class="unsubscribe">
        You received this email because you subscribed to our newsletter.
        <br><a href="{{ url('newsletter/unsubscribe', $subscriberEmail) }}" style="color:#aaa;text-decoration:underline">Unsubscribe</a>
    </p>
  </div>

</div>
</body>
</html>
