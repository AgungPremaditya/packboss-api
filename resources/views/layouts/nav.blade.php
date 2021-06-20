{{-- NAV --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <span class="navbar-brand">PackBoss</span>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/home">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/transaction">Transaction</a>
      </li>
      @if (Auth::user()->role == 'admin')
      <li class="nav-item">
        <a class="nav-link" href="/operator">Operator</a>
      </li>
      @endif
    </ul>
  </div>
</nav>
{{-- END-NAV --}}