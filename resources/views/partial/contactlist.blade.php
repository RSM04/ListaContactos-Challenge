<table class="table col-md-12" id="tablacontactos">
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
                <td><button type="button" contact="{{$contacto->id}}" class="btn btn-info" data-toggle="modal" data-target="#modalPoll-1" id="edit{{$contacto->id}}">Edit</button> <button id="eliminar{{$contacto->id}}" contacto="{{$contacto->id}}" class="btn btn-danger pop">Eliminar</button>
                </td>
            </tr>
        @empty
            <p>No hay contactos!</p>
        @endforelse
        </tbody>
    </table>
<!-- Modal: modalPoll -->
<div class="row">
    @if($paginastotales<2)
        @else
        @for($i = 0;$i<$paginastotales;$i++)
            <div class="col-md-2">
                <button type="button" class="btn btn-info loadmore">{{$i}}</button>
            </div>
            @endfor
        @endif
</div>



