{{-- NAV --}}
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
    <ul class="navbar-nav">
      <li class="nav-item {{request()->routeIs('home') ? 'active' : ''}}">
        <a class="nav-link" href="/home">Home </a>
      </li>
      <li class="nav-item {{request()->routeIs('transaction.index') ? 'active' : ''}}">
        <a class="nav-link" href="/transaction">Transaction</a>
      </li>
      <li class="nav-item {{request()->routeIs('transport.index') ? 'active' : ''}}">
        <a class="nav-link" href="/transport">Transport</a>
      </li>
      @if (Auth::user()->role == 'admin')
      <li class="nav-item {{request()->routeIs('operator.index') ? 'active' : ''}}">
        <a class="nav-link" href="/operator">Operator</a>
      </li>
      @endif
    </ul>
  </div>
  <div class="mx-auto order-0">
      <a class="navbar-brand mx-auto" href="/home">PackBoss</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
          <span class="navbar-toggler-icon"></span>
      </button>
  </div>
  <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
      <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/logout">Logout</a>
          </li>
      </ul>
  </div>
</nav>
{{-- END-NAV --}}