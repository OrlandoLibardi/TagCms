@extends('admin.layout.admin') @section( 'breadcrumbs' )
<!-- breadcrumbs -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>Tags</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/admin">Paínel de controle</a>
            </li>
            <li class="active">Tags </li>
        </ol>
    </div>
    <div class="col-md-3 padding-btn-header text-right">
        <a href="javascript:saveTags();" class="btn btn-primary btn-sm salvar">Salvar</a>
        <a href="{{ Route('tags.index') }}" class="btn btn-warning btn-sm">Cancelar</a>
    </div>
</div>

@endsection @section('content')

<div class="row">
    <div class="col-md-8">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Tags cadastradas</h5>
                <div class="ibox-tools">
                    <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                </div>
            </div>
            <div class="ibox-content">
                <table class="table table-bordered" id="results">
                    <thead>
                        <tr>
                            <td width="10"><input type="checkbox" name="excludeAll"></td>
                            <td width="200">Nome</td>
                            <td>Valor</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @foreach($tags as $key=>$value)
                        <tr>
                            <td><input type="checkbox" name="exclude" value="{{ $key }}" data-id="{{ $i }}"> </td>
                            <td><input type="text" name="tag_name" data-id="{{ $i }}" value="{{ $key }}"
                                    class="form-control"></td>
                            <td><input type="text" name="tag_value" data-id="{{ $i }}" value="{{ $value }}"
                                    class="form-control"></td>
                        </tr>
                        @php $i++ @endphp
                        @endforeach
                    </tbody>
                </table>
                <a href="javascript:newLine();" class="btn btn-sm btn-flat btn-info pull-right">Adicionar nova Tag</a>
            </div>
        </div>


    </div>
</div>
{!! Form::open(['route' => 'tags.store', 'method' => 'POST', 'id' => 'form-tags']) !!}
{!! Form::hidden('tags', null) !!}
{!! Form::close() !!}
<input name="route_create" value="{{ Route('tags.create') }}" type="hidden">
<input name="route_delete" value="/admin/tags/destroy/" type="hidden">
@endsection
@push('style')
<!-- Adicional Styles -->
<link rel="stylesheet" href="{{ asset('assets/theme-admin/css/plugins/OLForm/OLForm.css') }}">
@endpush
@push('script')
<!-- Adicional Scripts -->
<script src="{{ asset('assets/theme-admin/js/main.js') }}"></script>
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLForm.jquery.js') }}"></script>
<!-- exclude -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLExclude.jquery.js') }}"></script>
<script>
$("#form-tags").OLForm({
    listErrorPosition: 'after',
    listErrorPositionBlock: '.modal-header',
    btn: true
});
/*Exclude*/
$("#results").OLExclude({
    'action': $("input[name=route_delete]").val(),
    'inputCheckName': 'exclude',
    'inputCheckAll': 'excludeAll'
});


function saveTags()
{
    var tags = {};
    $("#results").find('input[name=tag_name]').each(function() {
        tags[$(this).val()] = $("input[name=tag_value][data-id="+$(this).attr("data-id")+"]").val();
    });
    $("input[name=tags]").val(JSON.stringify(tags));
    $("#form-tags").submit();
}

/* Mascara */

$(document).on("change", "input[name=tag_name]", function(){
    var slug = slugar($(this).val());
    $(this).val(slug);
    $("input[name=exclude][data-id="+$(this).attr("data-id")+"]").val(slug);
});
/* Nova linha */
function newLine() 
{
    var max_line = 0;

    $("#results").find('input[type=checkbox]').each(function() {
        if ($(this).attr('data-id') > max_line) max_line = $(this).attr('data-id');
    });

    max_line++;

    var obj = '<tr>';
    obj += '<td><input type="checkbox" name="exclude" value="" data-id="' + max_line + '"> </td>';
    obj += '<td><input type="text" name="tag_name" data-id="' + max_line + '" value="" class="form-control"></td>';
    obj += '<td><input type="text" name="tag_value" data-id="' + max_line + '" value="" class="form-control"></td>';
    obj += '</tr>';

    $("#results tbody").append(obj);
}
function slugar(v)
{
    return v.toString()
            .toLowerCase()
            .replace(/[àÀáÁâÂãäÄÅåª]+/g, 'a')
            .replace(/[èÈéÉêÊëË]+/g, 'e')
            .replace(/[ìÌíÍîÎïÏ]+/g, 'i')
            .replace(/[òÒóÓôÔõÕöÖº]+/g, 'o')
            .replace(/[ùÙúÚûÛüÜ]+/g, 'u')
            .replace(/[ýÝÿŸ]+/g, 'y')
            .replace(/[ñÑ]+/g, 'n')
            .replace(/[çÇ]+/g, 'c')
            .replace(/[ß]+/g, 'ss')
            .replace(/[Ææ]+/g, 'ae')
            .replace(/[Øøœ]+/g, 'oe')
            .replace(/[%]+/g, 'pct')
            .replace(/\s+/g, '_')
            .replace(/[^\w\-]+/g, '')
            //.replace(/\-\-+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '');
}
</script>

@endpush