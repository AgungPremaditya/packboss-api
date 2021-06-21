{{-- NAV --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <span class="navbar-brand">PackBoss</span>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item {{request()->routeIs('home') ? 'active' : ''}}">
        <a class="nav-link" href="/home">Home </a>
      </li>
      <li class="nav-item {{request()->routeIs('transaction.index') ? 'active' : ''}}">
        <a class="nav-link" href="/transaction">Transaction</a>
      </li>
      @if (Auth::user()->role == 'admin')
      <li class="nav-item {{request()->routeIs('operator.index') ? 'active' : ''}}">
        <a class="nav-link" href="/operator">Operator</a>
      </li>
      <li class="nav-item {{request()->routeIs('transport.index') ? 'active' : ''}}">
        <a class="nav-link" href="/transport">Transport</a>
      </li>
      @endif
    </ul>
  </div>
</nav>
{{-- END-NAV --}}