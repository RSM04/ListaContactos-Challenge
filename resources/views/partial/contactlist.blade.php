<table class="table" id="tablacontactos">
        <thead class="black white-text">
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Email</th>
            <th scope="col">Categorias</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @forelse($contactos as $contacto)
            <tr>
                <td>{{$contacto->name}}</td>
                <td>{{$contacto->surname}}</td>
                <td>{{$contacto->email}}</td>
                <td>{{$contacto->categories}}</td>
                <td><button type="button" contact="{{$contacto->id}}" class="btn btn-info" id="edit{{$loop->index}}">Edit</button> <button contacto="{{$contacto->id}}" class="btn btn-danger pop" data-toggle="popover" data-placement="bottom"
                                                                                                                                      data-content="">Eliminar</button>
                </td>
            </tr>
        @empty
            <p>No hay contactos!</p>
        @endforelse
        </tbody>
    </table>
<div id="dialog">
</div>


