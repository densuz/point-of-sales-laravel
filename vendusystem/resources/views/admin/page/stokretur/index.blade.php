@extends('admin.layouts.frame')
@section('title', 'Stok Returs')
@section('description')
    Returan daftar stok retur
@endsection


@section('content')
    <div class="container-fluid container-fixed-lg">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading p-b-15">
                        <div class="panel-title">
                            {!! Form::open(['url' => 'admin/retur', 'method' => 'get', 'class' => 'form-inline']) !!}
                            {!! Form::text('tanggal_mulai', null, ['class' => 'form-control input-md  b-rad-md search-text datepicker-text input-re', "placeholder" => "Tanggal Mulai", 'readonly']) !!}
                            {!! Form::text('tanggal_selesai', null, ['class' => 'form-control input-md  b-rad-md search-text datepicker-text input-re', "placeholder" => "Tanggal Selesai", 'readonly']) !!}
                            <button class="btn btn-success btn-rounded btn-xs" type="submit" style="width:28px;height:28px;margin-right:4px;margin-left:-15px;"><i class="fa fa-search" style="width:8px;"></i></button>
                            {!! Form::close() !!}
                        </div>
                        <a href="{{ url('admin/retur/create') }}" class="btn btn-complete pull-right btn-rounded btn-xs" type="button" style="width:28px;height:28px;margin-right:4px;margin-top: 3px"><i class="fa fa-plus" style="width:8px;"></i></a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body b-t b-grey no-padding" style="background: #FFF;">
                        <div class="widget-11-2-table">
                            <table class="table table-hover table-t-b-0">
                                <tbody>
                                <tr>
                                    <td style="min-width: 20px;">No</td>
                                    <td width="25%">Tanggal</td>
                                    <td width="15%">Jumlah</td>
                                    <td width="20%">Pemasok</td>
                                    <td style="min-width: 80px;">Dibuat</td>
                                    <td style="min-width: 80px;">Diperbarui</td>
                                    <td style="min-width: 150px;">Action</td>
                                </tr>
                                @if(count($stokreturs) == 0)
                                <tr class="no-data-empty">
                                    <td colspan="7">Data Kosong</td>
                                </tr>
                                @endif
                                @foreach($stokreturs as $stokretur)
                                <tr id="Barcode{{ $stokretur->id }}">
                                    <td>{{ $no++ }}.</td>
                                    <td class="font-montserrat fs-12">
                                        <a href="{{ url('admin/retur/'.$stokretur->id) }}">{{ $stokretur->formatedDate($stokretur->tanggal) }}</a>
                                    </td>
                                    <td class="text-left b-r b-dashed b-grey">
                                        <span class="hint-text">{{ $stokretur->getDaftar()->sum('jumlah') }} Barang</span><br/>
                                    </td>
                                    <td class="text-left b-r b-dashed b-grey">
                                        <span class="hint-text">{{ $stokretur->getNamaPemasok() }}</span><br/>
                                    </td>
                                    <td class="b-r b-dashed b-grey"><span class="font-montserrat fs-10">{!! $stokretur->formatedDate($stokretur->created_at) !!}</span></td>
                                    <td class="b-r b-dashed b-grey"><span class="font-montserrat fs-10">{!! $stokretur->formatedDate($stokretur->updated_at) !!}</span></td>
                                    <td class="font-montserrat fs-12">
                                        <a onClick="deleteData({{ $stokretur->id }}, 'Barcode')" class="btn btn-danger b-rad-md btn-xs" type="button" style="height:28px;margin-right:4px;margin-top: -5px;">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="panel-footer no-border p-t-0 p-b-0" style="background: #FFF;color: #101010;font-size: 13px;font-weight: 300">
                        {{ $stokreturs->appends($appends)->links()  }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" id="deleteID" />
    <input type="hidden" id="deleteSD" />
@endsection


@push("script")
<script>

    $(document).ready(function() {

        $('.datepicker-text').datepicker({
            todayBtn: true,
            todayHighlight: true,
            toggleActive: true,
            clearBtn: true,
            defaultViewDate: true,
            language: 'id'
        });
    });

    function deleteData(id, stokretur) {
        $('#modalDelete').modal('show');
        $('#deleteID').val(id);
        $('#deleteSD').val(stokretur);
    }

    function hapus(){
        $('#modalDelete').modal('hide');
        var id = $('#deleteID').val();
        var sd = $('#deleteSD').val();
        $.ajax({
            url: '{{url("admin/retur")}}' + "/" + id + '?' + $.param({"cont": sd, "_token" : '{{ csrf_token() }}' }),
            type: 'DELETE',
            complete: function(data) {
                $('#'+sd+ id).remove();
            }
        });
    }
</script>
@endpush
