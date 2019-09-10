<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
{{--    Jquery UI css--}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
{{--    Mdbootstrap CSS--}}
<!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.9/css/mdb.min.css" rel="stylesheet">
    <link href="//localhost:8000/css/bootstrap-tagsinput.css" rel="stylesheet">

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
{{--    Jquery UI--}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//localhost:8000/js/bootstrap-tagsinput.js"></script>
    <script src="//localhost:8000/js/typeahead.js"></script>



    {{--    Local CSS--}}
{{--    <link href="//localhost:8000/css/app.css" rel="stylesheet">--}}
</head>

<body class="winter-neva-gradient
">

<div class="container col-md-12">
    <div class="container-body col-md-10 offset-1">
        <div class="contenido">
            @yield('content')
        </div>
    </div>
</div>
<script>
    $(()=>{
        $.get('{{route('getlistcontacts')}}',(data)=>{
            $('#tabladecontactos').html(data);
                $("#dialog").dialog({
                    autoOpen: false, modal: true, show: "blind", hide: "blind"
                });
            $('.pop').on('click', function (el) {
                let contactoid = $(el.target).attr('contacto');
                let popupElement = `Eliminar Contacto <a id="delete" class="btn btn-danger" href="#${contactoid}">Si</a><a id="cancelar" class="btn btn-info">Cancelar</a> `;
                $('[data-toggle="popover"]').popover({
                    animation: true,
                    content: popupElement,
                    html: true
                });
            })
            $("[data-toggle=popover]").on('shown.bs.popover', function () {
                $('#delete').on('click',(el)=>{
                    let contactoid = $(el.target).attr('href').substr(1);
                    console.log(contactoid);
                    $.ajax({
                        url:'/contacto/'+contactoid+'/destroy',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type:'DELETE',
                        success: function(result) {
                            $('#tabladecontactos').html(result);
                        },
                    })
                })            });

                $('button[id*="edit"]').click(function () {
                    var nombre = $(this.parentElement.parentElement.children[0]).text();
                    var apellido = $(this.parentElement.parentElement.children[1]).text();
                    var email = $(this.parentElement.parentElement.children[2]).text();
                    let id = $(this).attr("id").substr(4);
                    let form = '<form id="formulario">\n' +
                        '        <fieldset>\n' +
                        '            <label for="name">Nombre</label>\n' +
                        '            <input type="text" name="name" id="name" value="" class="text ui-widget-content ui-corner-all">\n' +
                        '            <label for="name">Apellido</label>\n' +
                        '            <input type="text" name="surname" id="surname" value="" class="text ui-widget-content ui-corner-all">\n' +
                        '            <label for="email">Email</label>\n' +
                        '            <input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all">\n' +
                        '            <input type="text" tabindex="-1" style="position:absolute; top:-1000px">\n' +
                        '            <input type="button" id="enviar" value="enviar">\n' +

                        '        </fieldset>\n' +
                        '    </form>'
                    $("#formulario").remove();
                        $('#dialog').append(form);
                        $('#name').val(nombre);
                    $('#surname').val(apellido);
                    $('#email').val(email);
                    $("#dialog").dialog("open");
                    return false;
                });
            $('#añadircontacto').on('click',()=>{
                $("#formulario").remove();
                $('#dialog').append('<form id="formulario">\n' +
                    '        <fieldset>\n' +
                    '            <label for="name">Nombre</label>\n' +
                    '            <input type="text" name="name" id="name" value="" class="text ui-widget-content ui-corner-all">\n' +
                    '            <label for="name">Apellido</label>\n' +
                    '            <input type="text" name="surname" id="surname" value="" class="text ui-widget-content ui-corner-all">\n' +
                    '            <label for="email">Email</label>\n' +
                    '            <input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all">\n' +
                    '            <input type="text" tabindex="-1" style="position:absolute; top:-1000px">\n' +
                    '            <input type="button" id="enviar" value="enviar">\n' +
                    '        </fieldset>\n' +
                    '    </form>');
                $("#dialog").dialog("open");
                    $('#enviar').on('click',()=>{
                        $.ajax({
                                url:'/contacts/'+$('#name').val()+'/'+$('#surname').val()+'/'+$('#email').val(),
                            },(data)=>{
                                console.log("hola")
                                $('#tabladecontactos').html(data);
                            })
                    })
                $('#dialog').on('dialogopen',()=>{

                })

            })

        })

    })

</script>
<script>
    var categories = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: {
            url: '{{route('totalcategories')}}',
            filter: function(list) {
                return $.map(list, function(categories) {
                    return { name: categories }; });
            }
        }
    });
    categories.initialize();
    console.log(categories)

    $('input').tagsinput({
        typeaheadjs: {
            name: 'citynames',
            displayKey: 'name',
            valueKey: 'name',
            source: categories.ttAdapter()
        }
    });
</script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.9/js/mdb.min.js"></script>
</body>
</html>