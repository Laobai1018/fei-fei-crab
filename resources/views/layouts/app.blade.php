<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'Fei Fei Crab')</title>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+SC:wght@800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
body{margin:0;font:16px/1.5 Inter,sans-serif;background:#FBF6EF;color:#1F1A17}
.bar{display:flex;flex-wrap:wrap;gap:12px;justify-content:space-between;align-items:center;padding:16px 5%;border-bottom:1px solid #E8DDD0}
.brand{font:800 26px 'Noto Serif SC',serif;color:#B3321F;text-decoration:none}
.brand small{font:400 14px Inter,sans-serif;color:#6B5F55;margin-left:8px}
nav{display:flex;gap:20px;align-items:center}nav a{color:#1F1A17;text-decoration:none;font-weight:500}
.wrap{max-width:1100px;margin:0 auto;padding:32px 24px}
.card{background:#fff;border:1px solid #E8DDD0;border-radius:16px;padding:28px;width:100%;max-width:440px;box-sizing:border-box}
h1,h2{font-family:'Noto Serif SC',serif;margin:0 0 16px}
label{display:block;font-size:14px;font-weight:500;margin:14px 0 6px}
input,select,textarea{width:100%;box-sizing:border-box;height:46px;padding:0 12px;border:1px solid #CDBFAF;border-radius:10px;font:inherit;background:#fff}
textarea{height:90px;padding:10px 12px}
.btn{display:inline-block;height:46px;line-height:46px;padding:0 22px;border:0;border-radius:10px;background:#B3321F;color:#fff;font:600 16px Inter,sans-serif;cursor:pointer;text-decoration:none;box-sizing:border-box}
.btn.alt{background:#fff;color:#1F1A17;border:1px solid #CDBFAF;line-height:44px}
.btn.sm{height:36px;line-height:36px;padding:0 14px;font-size:14px}
.btn.sm.alt{line-height:34px}
.btn.del{background:#fff;color:#B3321F;border:1px solid #B3321F;line-height:34px}
.err{color:#B3321F;font-size:14px;margin-top:6px}
.ok{background:#E6F2E4;color:#1D4D1A;padding:12px 16px;border-radius:10px;margin-bottom:16px}
.tw{overflow-x:auto}
table{width:100%;border-collapse:collapse;background:#fff;border:1px solid #E8DDD0}
th,td{text-align:left;padding:10px 12px;border-bottom:1px solid #E8DDD0;font-size:14px;white-space:nowrap}
.row{display:flex;gap:8px}
.head{display:flex;flex-wrap:wrap;gap:12px;justify-content:space-between;align-items:center;margin-bottom:16px}
.grid{display:flex;flex-wrap:wrap;gap:32px;align-items:flex-start}
.muted{color:#6B5F55}
form.inline{display:inline;margin:0}
</style>
</head>
<body>
<div class="bar">
<a class="brand" href="/">肥肥蟹<small>Fei Fei Crab · Kuching</small></a>
<nav>
@if(auth()->check() && auth()->user()->is_admin)
<a href="{{ route('admin.reservations.index') }}">Bookings</a>
<a href="{{ route('admin.customers.index') }}">Customers</a>
<form class="inline" method="POST" action="{{ route('logout') }}">@csrf<button class="btn sm alt">Log out</button></form>
@elseif(session()->has('customer_id') || session('guest'))
<form class="inline" method="POST" action="{{ route('logout') }}">@csrf<button class="btn sm alt">Log out</button></form>
@endif
</nav>
</div>
<div class="wrap">
@if(session('ok'))<div class="ok">{{ session('ok') }}</div>@endif
@yield('content')
</div>
</body>
</html>
