<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Preview — {{ $campaign->subject }}</title>
<style>
  *{margin:0;padding:0;box-sizing:border-box}
  body{background:#f4f6fb;font-family:'Segoe UI',Arial,sans-serif;color:#333}
  .wrap{max-width:600px;margin:32px auto;background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.08)}
  .header{background:#2d6fa3;padding:36px 40px 28px;text-align:center}
  .header h1{color:#fff;font-size:24px;font-weight:700;line-height:1.3}
  .header-image img{width:100%;max-height:280px;object-fit:cover;display:block}
  .body{padding:36px 40px;font-size:15px;line-height:1.8;color:#555}
  .body h2{color:#2d6fa3;font-size:20px;margin:24px 0 12px}
  .body h3{color:#1e293b;font-size:17px;margin:20px 0 10px}
  .body p{margin-bottom:14px}
  .body ul,.body ol{margin:12px 0 16px 24px}
  .body li{margin-bottom:6px}
  .body a{color:#2d6fa3}
  .body img{max-width:100%;border-radius:8px;margin:16px 0}
  .footer{background:#f8f9fc;padding:20px 40px;text-align:center;font-size:12px;color:#aaa;border-top:1px solid #eee}
  .footer a{color:#2d6fa3;text-decoration:none}
  .toolbar{text-align:center;padding:16px;margin-top:16px}
  .toolbar .btn-close{display:inline-flex;align-items:center;gap:8px;padding:10px 24px;background:#2d6fa3;color:#fff;border:none;border-radius:8px;font-size:14px;cursor:pointer;text-decoration:none;transition:all .2s}
  .toolbar .btn-close:hover{background:#1a4a7a}
</style>
</head>
<body>

<div class="toolbar">
    <a href="javascript:window.close()" class="btn-close">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        Close Preview
    </a>
</div>

<div class="wrap">
    <div class="header">
        <h1>{{ $campaign->subject }}</h1>
    </div>

    @if($campaign->image_url)
    <div class="header-image">
        <img src="{{ $campaign->image_url }}" alt="Newsletter header image">
    </div>
    @endif

    <div class="body">
        {!! $campaign->content !!}
    </div>

    <div class="footer">
        <p><strong style="color:#2d6fa3">Krousar Thmey</strong> · Cambodia since 1991</p>
        <p><a href="{{ url('/') }}">krousar-thmey.org</a> &nbsp;·&nbsp; <a href="mailto:info@krousar-thmey.org">info@krousar-thmey.org</a></p>
        <p style="margin-top:8px;color:#aaa;font-size:11px">
            This is a preview. The actual email will include an unsubscribe link.
        </p>
    </div>
</div>

</body>
</html>
