@extends('layouts.master')

@section('content')


@foreach ($projet as $p)


@if (count($clients))

@foreach($clients as $client)

@if ($p->id_client == $client->id)
<h4> Nom du client : </h4> <h6>{{ $client->name }}<h6>

@endif

@endforeach

@endif


<div class="form-group">
    {!! Form::label('ldescription', 'Description:', ['class' => 'control-label']) !!}
<h6>{!!$p->description!!}</h6>
</div>

<!-- produits -->

@if(isset($pp))
<table class="table table-condensed">
<tr>
<td> Nom de produit utilisé </td>
<td> Quantité </td>
</tr>
@for ($i=0; $i<count($pp);$i++) 
<tr>
<td> {{ $produits_noms[$i] }} </td>
<td> {{ $pp[$i]->quantite }} </td>
</tr>
@endfor
</table>
@endif


<div class="form-group">
        <div class="col-xs-5 date">
    {!! Form::label('date_debut', 'Date de debut :', ['class' => 'control-label']) !!}
            <div class="input-group input-append date" id="datePicker">
                <h6>{{$p->date_debut}}</h6>
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>

        <div class="col-xs-5 date">
    {!! Form::label('date_fin', 'Date de fin :', ['class' => 'control-label']) !!}
            <div class="input-group input-append date" id="datePicker">
                <h6>{{$p->date_fin}}</h6>
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
</div>




</br></br></br>
<a href ='{!! url('projets/modifier',$p->id) !!}'  class='btn btn-primary'>Modifier</a>
<a href ='{!! url('projets/supprimer',$p->id) !!}'  class='btn btn-danger'>Supprimer</a>
<a href ='{!! route('projets.index') !!}'  class='btn btn-success'>Retour</a>

@endforeach

@stop
