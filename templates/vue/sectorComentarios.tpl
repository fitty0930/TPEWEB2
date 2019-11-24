{literal}
<section id="comentarios_api">
    <div class="card col-md-6">
    <div  v-if= "comentarios[0]" class="col-md-12">
        Este es el promedio
        {{promedio}}
    </div>
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Comentarios</h4>
                <button id="btn-refresco" type="button" class="btn btn-primary btn-sm">Refrescar</button>
            </div>

            <div v-if="loading" class="card-body">
                Cargando...
            </div>
            
            <ul v-if="!loading" class="list-group list-group-flush">
                <a v-for="comentario in comentarios" class="list-group-item list-group-item-action"> 
                
                    {{ comentario.cuerpo }} 
                    {* marca *}
                        <div class="card-footer text-muted">
                    <li>Usuario: {{ comentario.nombre_usuario }}</li> 
                    <li>Puntaje: {{comentario.puntaje}}</li>
                        </div>
                {/literal}
                {if $admin}
                    {literal}
                    <button  @click="(event)=>{deleteComent(event, comentario.id_comentario)}" class="delete">Delete</button>
                    {/literal}
                    {/if}
                    {literal}
                </a>
            </ul>
    </div>
    {/literal}
    {if $nombreUsuario}
    {literal}
    <div class="col-3">
        <h5 class="mb-0">Agrega tu comentario</h4>
        <input type="text" name="" id="texto-comentario">
        <label for="">Puntaje</label>
        <select name="" id="puntaje-comentario">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <button  @click="agregarComentario">Agregar</button>
    </div>
    {/literal}
    {/if}
    {literal}
       
        
</section>
{/literal}