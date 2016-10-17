@extends('layouts.master')

@section('content')


@if (count($produit_data))

<table class="table table-condensed">
<tr>
<td> Type  </td>
<td> Description  </td>
<td> Date  </td>
<td> Nom produit  </td>
<td> Code produit  </td>
<td> Quantité  </td>
</tr>

@for ($i=0; $i<count($produit_data);$i++)
<tr>
<td> {{ $operations[$i]->type }} </td>
<td> {{ $operations[$i]->description }} </td>
<td> {{ $operations[$i]->created_at }} </td>
<td> {{ $produit_data[$i][0] }} </td>
<td> {{ $produit_data[$i][1] }} </td>
<td> {{ $operations[$i]->qauntite }} </td>
</tr>
@endfor
<table>
@endif





@stop
