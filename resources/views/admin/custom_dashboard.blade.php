@if(request()->routeIs('admin.home'))
    <!-- Home link won't be displayed if you're already on the home page -->
@else
    <a href="{{ route('admin.home') }}">Home</a>
@endif


<div class="custom-statistics">
    <h2>Dashboard Stats</h2>
    <p>Total Immeubles: {{ $data['totalImmeubles'] }}</p>
    <p>Average Price: {{ $data['averagePrice'] }}</p>
</div>
