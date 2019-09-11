<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ListaContactos-Challenge</title>
    <!-- JQuery -->
    <script type="text/javascript" src="//localhost:8000/js/jquery-3.4.1-min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="//localhost:8000/css/fontawesome.css">
{{--    Jquery UI css--}}
<!-- Bootstrap core CSS -->
    <link href="//localhost:8000/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//localhost:8000/css/jquery-ui.css">
    <!-- Material Design Bootstrap -->
    <link href="//localhost:8000/css/mdb.min.css" rel="stylesheet">
    <link href="//localhost:8000/css/bootstrap-tagsinput.css" rel="stylesheet">

    <!-- JQuery -->
    <script type="text/javascript" src="//localhost:8000/js/jquery-3.4.1-min.js"></script>
    {{--    Bootstrap--}}

    <script type="text/javascript" src="//localhost:8000/js/bootstrap.min.js"></script>
    {{--    Jquery UI--}}
    <script src="//localhost:8000/js/jquery-ui.js"></script>
    {{--    Bootstrap tokenfield CSS--}}
    <link href="//localhost:8000/css/bootstrap-tokenfield.min" rel="stylesheet">
    <script src="//localhost:8000/js/bootstrap-tokenfield.js"></script>
    <link href="//localhost:8000/css/app.css" rel="stylesheet">



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
    $(document).on('click',(el)=>{
        if($(el.target).attr('class') == 'btn btn-info loadmore'){
            $.get('/contacts/pagination/'+$(el.target).text(),(data)=>{
                $('#tabladecontactos').html(data);
            })
        }
        else if($(el.target).attr('id').includes('eliminar',0)){
            let nombre = $(el.target.parentElement.parentElement.children[0]).text()
            let apellido = $(el.target.parentElement.parentElement.children[1]).text()

            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height: "auto",
                width: 400,
                modal: true,
                buttons: [{

                    text: "Eliminar",
                    "class": "btn btn-warning",
                    click: function () {
                        $.ajax({
                            url: '/contacto/' + contactoid + '/destroy',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'DELETE',
                            success: function (result) {
                                $('#tabladecontactos').html(result);
                                $('#dialog-confirm').dialog("close");
                            },
                        })
                    }
                },{
                    text:"Cancelar",
                    "class":"btn btn-danger",
                    click: function() {
                        $( this ).dialog( "close" );
                    }
                }]
            });
            $('#dialog-confirm').empty()
            $('#dialog-confirm').append('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Vas a borrar a <strong class="eliminaruser" style="color:red; font-weight: bold">'+ nombre+' ' + apellido+' </strong>de tu lista de contactos, <strong class="eliminaruser" style="color:red; font-weight: bold">no se prodrá recuperar!</strong></p>\n')
            let contactoid = $(el.target).attr('id').substr(8);
        }
        else if($(el.target).attr('id').includes('edit',0)){
            console.log()
                var nombre = $(el.target.parentElement.parentElement.children[0]).text();
                var apellido = $(el.target.parentElement.parentElement.children[1]).text();
                var email = $(el.target.parentElement.parentElement.children[2]).text();
            var categorias = $(el.target.parentElement.parentElement.children[3]).text();
            let id = $(el.target).attr('id').substr(4);
                $( "#dialog-edit" ).dialog({
                    resizable: false,
                    height: "auto",
                    width: 400,
                    modal: true,
                    buttons: [

                        {
                            text:"Cancelar",
                            "class":"btn btn-danger",
                            click: function() {
                                $( this ).dialog( "close" );
                            }
                        }]
                });
                $("#formulario").empty();
                let form = `<form id="formulario">
                            <fieldset>
                                <div class="md-form">
                                    <input type="text" name="name" id="name" value="" class="form-control">
                                    <label for="name" class="active">Nombre</label>
                                </div>
                                <div class="md-form">
                                    <label for="name" class="active">Apellido</label>
                                    <input type="text" name="surname" id="surname" value="" class="text ui-widget-content ui-corner-all">
                                </div>
                                <div class="md-form">
                                    <label for="email" class="active">Email</label>
                                    <input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all">
                                </div>
                                <div class="md-form">
                                    <label for="email" class="active">Categories</label>
                                    <input type="text" value="" id="categorias" name="categorias"/>
                                </div>

                               <input type="text" tabindex="-1" style="position:absolute; top:-1000px">
                               <input type="submit" class="btn btn-primary btn-md"><br>
                            </fieldset>
                        </form>`
                $('#dialog-edit').empty()
                $('#dialog-edit').append(form);
            //TokenFieldset
            $.get('{{route('categoriesjson')}}',(data)=>{
                $('#categorias').tokenfield({
                    autocomplete:{
                        source: data,
                        delay:100
                    },
                    showAutocompleteOnFocus: true
                });
            })
                //Aañado valores a los ids
                $('#name').val(nombre);
                $('#surname').val(apellido);
                $('#email').val(email);
            $('#categorias').val(categorias);
            $('#formulario').on('submit',(e)=>{
                    e.preventDefault();
                var categoriasintroducidas = $('#categorias').val().split(',')
                $.get('{{route('categoriesjson')}}',(data)=>{
                    categoriasintroducidas.forEach((categoria)=>{
                        let añadir = data.find(function(elemento){
                            return elemento == categoria
                        })
                        if(añadir == undefined){
                            console.log('añadiendo')
                            console.log(categoria)
                            $.get('/categoria/add/'+categoria,(data)=>{
                                console.log(data)
                            });
                        }
                       })
                   })

                    $.ajax({
                        url: '/contacts/'+id,
                        type:'PUT',
                        data: $('#formulario').serialize(),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(result) {
                            $('#tabladecontactos').html(result);
                            $('#dialog-edit').dialog('close')
                        },
                    })
                })
        }
    })
    // $('[id*="eliminar"]').on('click',(el)=>{
    //
    // })
    $(()=>{
        $.get('{{route('getlistcontacts')}}',(data)=>{

            $('#tabladecontactos').html(data);





            $('button[id*="añadir"]').on('click',()=>{
                $( "#dialog-add" ).dialog({
                    resizable: false,
                    height: "auto",
                    width: 400,
                    modal: true,
                    buttons: [
                        {
                            text: "Añadir",
                            "class": "enviarr btn btn-primary mb-0",
                            click: function () {$.get(
                                    '/contacts/'+$('#name').val()+'/'+$('#surname').val()+'/'+$('#email').val(),(data)=>{
                                    $('#tabladecontactos').html(data)
                                    $( this ).dialog( "close" );
                                })
                            }
                        },
                        {
                            text:"Cancelar",
                            "class":"btn btn-danger mb-0",
                            click: function() {
                            $( this ).dialog( "close" );
                        }
                    }]
                });
                $('#dialog-add').empty()
                $('#dialog-add').append(`<form id="formulario">
                            <fieldset>
                                <div class="md-form">
                                <input type="text" name="name" id="name" value="" class="form-control">
                                <label for="name" class="active">Nombre</label>
                                </div>
                                <div class="md-form">
                                <label for="name" class="active">Apellido</label><br>
                                <input type="text" name="surname" id="surname" value="" class="text ui-widget-content ui-corner-all">
                                </div>
                                <div class="md-form">
                                <label for="email" class="active">Email</label><br>
                                <input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all">
                                </div>
                               <input type="text" tabindex="-1" style="position:absolute; top:-1000px">
                            </fieldset>
                        </form>`);
                $("#dialog-add").dialog("open");
                    $('[id*="enviar"]').on('click',()=>{
                        $.ajax({
                                url:'/contacts/'+$('#name').val()+'/'+$('#surname').val()+'/'+$('#email').val(),
                            },(data)=>{
                                $('#tabladecontactos').html(data);
                            })
                    })
            })

        })

    })

</script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="//localhost:8000/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<!-- MDB core JavaScript -->
<script type="text/javascript" src="//localhost:8000/js/mdb.min.js"></script>
</body>
</html>