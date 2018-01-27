@extends ('layouts.base')

@section('class') portfolio-contact @endsection

@section('cellsupportingtext')

<p>Thank you, the receipt is emailed to {{ $charge->receipt_email }}.</p>
<p>Receipt number: {{ $charge->receipt_number }}.</p>

@endsection


