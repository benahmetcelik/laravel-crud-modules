@extends('backend.layouts.iframe')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Modül Oluşturun</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('backend.module.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Modül Adı</label>
                                            <input type="text" class="form-control" id="module_name" name="module_name"
                                                   placeholder="Modül Adı">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Model Adı</label>
                                            <input type="text" class="form-control" id="model_name" name="model_name"
                                                   placeholder="Model Adı" disabled="">
                                        </div>
                                    </div>
                                </div>

                                <h5>Tablo Alanları</h5>
                                <div class="row" id="table_creator">
                                    <div class="row mt-3 col-md-12">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Sütun</label>
                                                <input type="text" class="form-control" placeholder="Sütun Adı"
                                                       value="id" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tür</label>
                                                <select class="form-control" disabled>
                                                    <option value="string">String</option>
                                                    <option value="integer">Integer</option>
                                                    <option value="text">Text</option>
                                                    <option value="boolean">Boolean</option>
                                                    <option value="date">Date</option>
                                                    <option value="datetime">Datetime</option>
                                                    <option value="time">Time</option>
                                                    <option value="timestamp">Timestamp</option>
                                                    <option value="decimal">Decimal</option>
                                                    <option value="float">Float</option>
                                                    <option value="double">Double</option>
                                                    <option value="binary">Binary</option>
                                                    <option value="json">Json</option>
                                                    <option value="jsonb">Jsonb</option>
                                                    <option value="uuid">Uuid</option>
                                                    <option value="ipaddress">Ipaddress</option>
                                                    <option value="macaddress">Macaddress</option>
                                                    <option value="year">Year</option>
                                                    <option value="char">Char</option>
                                                    <option value="mediumtext">Mediumtext</option>
                                                    <option value="longtext">Longtext</option>
                                                    <option value="tinytext">Tinytext</option>
                                                    <option value="mediuminteger">Mediuminteger</option>
                                                    <option value="tinyinteger">Tinyinteger</option>
                                                    <option value="smallinteger">Smallinteger</option>
                                                    <option value="unsignedbiginteger">Unsignedbiginteger</option>
                                                    <option value="unsigneddecimal">Unsigneddecimal</option>
                                                    <option value="unsignedinteger">Unsignedinteger</option>
                                                    <option value="unsignedmediuminteger">Unsignedmediuminteger</option>
                                                    <option value="unsignedsmallinteger">Unsignedsmallinteger</option>
                                                    <option value="unsignedtinyinteger">Unsignedtinyinteger</option>
                                                    <option value="biginteger" selected>Biginteger</option>
                                                    <option value="mediumblob">Mediumblob</option>
                                                    <option value="longblob">Longblob</option>
                                                    <option value="tinyblob">Tinyblob</option>
                                                    <option value="blob">Blob</option>
                                                    <option value="geometry">Geometry</option>
                                                    <option value="point">Point</option>
                                                    <option value="linestring">Linestring</option>
                                                    <option value="polygon">Polygon</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Boş Olsun Mu?</label>
                                                <select class="form-control" disabled>
                                                    <option value="1">Evet</option>
                                                    <option value="0" selected>Hayır</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Default</label>
                                                <input type="text" class="form-control" placeholder="Default Değer"
                                                       disabled value="AUTOINCRIMENT">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>İşlem</label>
                                                <button type="button" class="btn btn-danger btn-block"
                                                        onclick="alert('ID Silinemez')">Sil
                                                </button>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-success btn-block" id="add_table_row">Sütun
                                            Ekle
                                        </button>
                                    </div>
                                </div>
                                <h5 class="mt-3">Form Alanları</h5>
                                <div class="row" id="form_creator">

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-success btn-block" id="add_form_row">Form
                                            Ekle
                                        </button>
                                    </div>
                                </div>


                                <!-- input states -->
                                <div class="form-group">
                                  <button type="submit" class="btn btn-outline-primary btn-block mt-3">Modül Oluştur</button>
                                </div>




                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div style="display: none" id="table_row">



    </div>


    <div style="display: none" id="form_row">

    </div>




@endsection

@push('scripts')
    <script>
        $(function () {

            $('#module_name').keypress(function (e) {
                if (e.which === 32) {

                    return false;
                }
                var module_name = $(this).val();
                var model_name = module_name.charAt(0).toUpperCase() + module_name.slice(1);

                $('#model_name').val(model_name);

            });

            $('#add_table_row').on('click', function () {
                let table_creator = $('#table_creator');
                let randID = Math.floor(Math.random() * 1000000000);
                let table_row = `
                     <div class="row mt-3 col-md-12">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Sütun</label>
                    <input type="text" class="form-control columnName" name="column[`+randID+`]" placeholder="Sütun Adı">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Tür</label>
                    <select class="form-control" name="type[`+randID+`]">
                        <option value="string">String</option>
                        <option value="integer">Integer</option>
                        <option value="text">Text</option>
                        <option value="boolean">Boolean</option>
                        <option value="date">Date</option>
                        <option value="datetime">Datetime</option>
                        <option value="time">Time</option>
                        <option value="timestamp">Timestamp</option>
                        <option value="decimal">Decimal</option>
                        <option value="float">Float</option>
                        <option value="double">Double</option>
                        <option value="binary">Binary</option>
                        <option value="json">Json</option>
                        <option value="jsonb">Jsonb</option>
                        <option value="uuid">Uuid</option>
                        <option value="ipaddress">Ipaddress</option>
                        <option value="macaddress">Macaddress</option>
                        <option value="year">Year</option>
                        <option value="char">Char</option>
                        <option value="mediumtext">Mediumtext</option>
                        <option value="longtext">Longtext</option>
                        <option value="tinytext">Tinytext</option>
                        <option value="mediuminteger">Mediuminteger</option>
                        <option value="tinyinteger">Tinyinteger</option>
                        <option value="smallinteger">Smallinteger</option>
                        <option value="unsignedbiginteger">Unsignedbiginteger</option>
                        <option value="unsigneddecimal">Unsigneddecimal</option>
                        <option value="unsignedinteger">Unsignedinteger</option>
                        <option value="unsignedmediuminteger">Unsignedmediuminteger</option>
                        <option value="unsignedsmallinteger">Unsignedsmallinteger</option>
                        <option value="unsignedtinyinteger">Unsignedtinyinteger</option>
                        <option value="biginteger">Biginteger</option>
                        <option value="mediumblob">Mediumblob</option>
                        <option value="longblob">Longblob</option>
                        <option value="tinyblob">Tinyblob</option>
                        <option value="blob">Blob</option>
                        <option value="geometry">Geometry</option>
                        <option value="point">Point</option>
                        <option value="linestring">Linestring</option>
                        <option value="polygon">Polygon</option>

                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Boş Olsun Mu?</label>
                    <select class="form-control" name="isNull[`+randID+`]">
                        <option value="1">Evet</option>
                        <option value="0">Hayır</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Uzunluk</label>
                    <input type="text" class="form-control" name="length[`+randID+`]" placeholder="Default Değer">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>İşlem</label>
                    <button type="button" class="btn btn-danger btn-block" onclick="removeRow(this)">Sil</button>
                </div>
            </div>
        </div>
`;
                table_creator.append(table_row);

            });

            $('#add_form_row').on('click', function () {
                let form_creator = $('#form_creator');
                let randId = Math.floor(Math.random() * 1000000000);
                let form_row = `
                 <div class="row mt-3 col-md-12">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Input Adı</label>
                    <input type="text" class="form-control" placeholder="Input Adı" name="inputName[`+randId+`]">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Input Türü</label>
                    <select name="inputType[`+randId+`]" class="form-control" id="`+randId+`" onchange="selectControl(this)">
                        <option value="text">Text</option>
                        <option value="textarea">Textarea</option>
                        <option value="number">Number</option>
                        <option value="file">File</option>
                        <option value="color">Color</option>
                        <option value="select">Select</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>İlgili Sütun  <a onclick="fillColumns('column`+randId+`')" href="#!">Yenile</a>  </label>
                    <select name="inputColumn[`+randId+`]" id="column`+randId+`" class="form-control" >
                        <option value="">Seçiniz</option>

                    </select>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label>Tabloda Göster
                    <input type="checkbox" name="showTable[`+randId+`]" class="form-control">
                    </label>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label>İşlem</label>
                    <button type="button" class="btn btn-danger btn-block" onclick="removeRow(this)">Sil</button>
                </div>
            </div>


        </div>
                `;
                form_creator.append(form_row);

            });


        })


        function removeRow(element) {
            $(element).parent().parent().parent().remove();
        }

        function selectControl(element) {
            let select = $(element).val();
            let select_id = $(element).id;
            if (select === 'select') {
                $(element).parent().parent().parent().append('<div class="col-md-2 select_input">\n' +
                    '                <div class="form-group">\n' +
                    '                    <label>Seçenekler</label>\n' +
                    '                   <smal>Buraya isterseniz model verebilirsiniz ÖRN: <b>Category::get()->pluck("id","title")->toArray(</b>)</smal>\n' +
                    '                    <input type="text" class="form-control" placeholder="Seçenekleri , ile ayırınız" name="inputOptions['+select_id+']">\n' +
                    '                </div>\n' +
                    '            </div>');
                $(element).parent().parent().parent().append('<div class="col-md-2 select_input">\n' +
                    '                <div class="form-group">\n' +
                    '                    <label>Varsa İlişki</label>\n' +
                    '                    <input type="text" class="form-control" placeholder="Seçeneklerin Değerlerini , ile ayırınız" name="inputOptionsValue['+select_id+']">\n' +
                    '                </div>\n' +
                    '            </div>');
            } else {
                $(element).parent().parent().parent().find('.select_input').remove();
            }
        }

        function fillColumns(id) {
            let columns = $('.columnName');
            let options = '';
            columns.each(function (index, value) {
                let column = $(value).val();
                if (column !== '') {
                    options += '<option value="' + column + '">' + column + '</option>';
                }

            });
            $('#'+id).html(options);
            console.log(options);

        }


        function removeInput(element) {
            $(element).parent().parent().parent().parent().remove();
        }

    </script>

@endpush
