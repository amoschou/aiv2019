@extends('public.layouts.base')

@section('class') portfolio-contact @endsection

@section('cellsupportingtext')
  @if(isset($essay))
    @foreach ($essay as $section)
      @if($section[0] !== '')
        <h3 class="mdl-typography--headline">{{ $section[0] }}</h3>
      @endif
      @foreach ($section[1] as $par)
        <p>{!! $par !!}</p>
      @endforeach
    @endforeach
  @endif
  @if(isset($text1))
    @foreach ($text1 as $par)
      <p>{{ $par }}</p>
    @endforeach
  @endif
  @section('receiptmessage')
  @stop

<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
  <tbody>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Name</th>
      <td>{{ $data->name }}</td>
    </tr>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Email</th>
      <td>{{ $data->email }}</td>
    </tr>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Phone</th>
      <td>{{ $data->phone }}</td>
    </tr>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Purpose of payment</th>
      <td>{{ $data->purpose }}</td>
    </tr>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Card type</th>
      <td>{{ ucfirst($data->cardtype) }}</td>
    </tr>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Payment value</th>
      <td>{{ $data->pv }}</td>
    </tr>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Transaction fee</th>
      <td>{{ $data->fee }}</td>
    </tr>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Total charge</th>
      <td>{{ $data->total }}</td>
    </tr>
  </tbody>
</table>

<form action="/stripe/checkout" method="POST">
  {{ csrf_field() }}
  <input type="hidden" name="name" value="{{ $data->name }}">
  <input type="hidden" name="email" value="{{ $data->email }}">
  <input type="hidden" name="phone" value="{{ $data->phone }}">
  <input type="hidden" name="purpose" value="{{ $data->purpose }}">
  <input type="hidden" name="cardtype" value="{{ $data->cardtype }}">
  <input type="hidden" name="pv" value="{{ $data->pv }}">
  <input type="hidden" name="fee" value="{{ $data->fee }}">
  <input type="hidden" name="total" value="{{ $data->total }}">
  <input type="hidden" name="totalincents" value="{{ $data->totalincents }}">
  <script
    src="https://checkout.stripe.com/checkout.js"
    class="stripe-button"
    data-key="{{ config('services.stripe.key') }}"
    data-amount="{{ $data->totalincents }}"
    data-name="AIVCF Adelaide"
    data-description="{{ $data->purpose }}"
    data-image="/style/css/images/aiv-bw-circled-300dpi.png"
    data-locale="auto"
    data-zip-code="true"
    data-currency="aud"
    data-panel-label="Pay @{{amount}}"
    data-email="{{ $data->email }}"
    data-label="Pay {{ $data->total }} with card"
    >
  </script>
</form>

@stop



