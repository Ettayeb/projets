@extends('layouts.master')

@section('content')
<a href={{route('produit.add')}} class="btn btn-success pull-right">Ajouter une produit</a>
</br></br>
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> <!-- end .flash-message -->

@if (count($produits))
<div>
	<table class="table table-condensed">
		<thead>
			<tr>
				<th>Nom de produit</th>
				<th>Code de produit</th>
				<th>Description</th>
				<th> quantité </th>
				<th> Prix unitaire </th>
			</tr>
		</thead>

@foreach($produits as $p)
		<tr>
			<td> {{ $p->nom }} </td>
			<td> {{ $p->code }} </td>
			<td> {{ $p->description }} </td>
			<td> {{ $p->quantite }} </td>
			<td> {{ $p->prix_unitaire }} </td>
			<td><a href="{{ url('produit/modifier',$p->id) }}" class="btn btn-primary">Modifier</a> </td>
			<!-- <td><a id='lien' href="#" dataref="{{ url('produit/supprimer',$p->id) }}"  class="btn btn-danger bbb">Supprimer</a></td> -->
			<td>
<div class="modal fade myModal" tabindex="1" role="dialog" id="{{ $p->id }}" aria-labelledby="myModalLabel" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content">
                	<div class="modal-header">
                		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        		<h4 class="modal-title" id="myModalLabel">Ajouter une quantité</h4>
                	</div>
                <div class="modal-body">
{!! Form::open([

    	'route'  => 'produit.operation',
	'method' => 'POST',
	'class'  => 'form-horizontal formRegister',
	'role'   => 'form' ,
]) !!}
<div class="form-group">
    {!! Form::label('l1', 'Quantité à ajouter :', ['class' => 'col-md-3 control-label']) !!}
    {!! Form::text('newquantite', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('l2', "Description :", ['class' => 'col-md-4 control-label']) !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>
    <div class="errors">

    </div>
    {!! Form::hidden('type','ajouts', ['class' => 'form-control']) !!}
    {!! Form::hidden('id', $p->id, ['class' => 'form-control']) !!}
{!! Form::submit('Ajouter une quantité', ['class' => 'btn btn-primary']) !!}
{!! Form::button('Cancel', ['data-dismiss' => 'modal' , 'class' => 'btn btn-danger']) !!}
{!! Form::close() !!}
</div>
</div>
</div>
</div>

<a href="#" class='btn btn-primary register' id='{{ $p->id }}' >Ajouter une quantité</a>
</td>
</tr>
@endforeach

</table>
</div>
@endif

{!! $produits->render() !!}

 

<!-- supprission de produit JS
<script>
$(document).ready(function() {
$(".bbb").on("click", function (e) {
    // Init
	
var link = $(this).attr("dataref");
    // Show Message        
    bootbox.confirm("Vous etes sur de vouloir supprimer cette produit ?", function (result) {
        if (result) {           
	                    document.location.href = link;  // if result, "set" the document location       
        }
    });
});
});

</script> Fin Supprission du produit JS
-->

<script>

    $(function(){
 
        $('.register').click(function() {
	var x = $(this).attr('id');
$('#'+x).modal();
         });

    $(document).on('submit', '.formRegister',function(e){
            e.preventDefault();
var $form = $(this);
var formdata = (window.FormData) ? new FormData($form[0]) : null ;
var data = (formdata !== null ) ? formdata : $form.serialize();

$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
});

$.ajax({

	url : $form.attr('action'),
	type : $form.attr('method'),
	contentType : false,
	processData : false,
	datatype : 'json',
	data : data
	}).always(function(response, status) {
  		if (response.status == 422) 

{
        	var errors = response.responseJSON;
		errorsHtml = '<div class="alert alert-danger"><ul>';
        	$.each(errors, function( key, value ) {
                errorsHtml += '<li>' + value[0] + '</li>';
        			});
        	errorsHtml += '</ul></di>';

$( '.errors' ).html( errorsHtml );

} else {
                location.reload(true);
            }
	
});


    });
 });

</script>


@stop
