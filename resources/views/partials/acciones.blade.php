                <div class="btn-acciones">
                    <div class="btn-circle d-flex justify-content-center">
                        <a href="{{ $actualizar }}" role="button" class="btn btn-success m-1 px-2 btn-sm "
                            title="Actualizar">
                            <span class="material-symbols-outlined">
                                edit
                            </span>
                        </a>
                        <button type="button" class="btn btn-danger  m-1 px-2 btn-sm " data-bs-toggle="modal"
                            data-bs-target="#{{ $ruta }}">
                            <span class="material-symbols-outlined">
                                delete
                            </span>
                        </button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="{{ $ruta }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar este
                                    registro?
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="modal-body">
                                    <p class="text-primary">
                                        <small>
                                            {{ $value['id'] . '. ' . $value['titulo'] }} </small>
                                    </p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <a href="{{ $eliminar }}" type="button" class="btn btn-danger">Eliminar</a>
                            </div>
                        </div>
                    </div>
                </div>
