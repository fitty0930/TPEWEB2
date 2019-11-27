{literal}
<section id="comentarios-api">
    <div class="card col-md-12">
    <div  v-if= "comentarios[0]" class="col-md-12">
        Puntuacion promedio del producto
        {{promedio}}
    </div>
            <div class="card-header d-flex justify-content-between">
                <h4 class="mb-0">{{titulo}}</h4>
                <button id="btn-ordenar-desc" type="button" class="btn btn-warning btn-sm"> Los mejores primero </button>
                <button id="btn-ordenar-asc" type="button" class="btn btn-danger btn-sm"> Los peores primero </button>
            </div>
            
            <div v-if="cargando" class="card-body">
                Cargando...
            </div>
            
            <ul v-else class="list-group">
                <div  v-if= "!comentarios[0]">
                    <p> todavia nadie dio su opinion, se el primero... </p>
                </div>
                <a v-for="comentario in comentarios" class="list-group-item list-group-item-action"> 
                        <div class="card-footer">
                            <li> Usuario: {{ comentario.nombre_usuario }}
                            Puntaje: {{comentario.puntaje}}</li>
                        </div>
                        <p>{{ comentario.texto }}</p> 
                {/literal}
                {if $admin}
                    {literal}
                    <button class="btn btn-danger" @click="(event)=>{borrarComentario(event, comentario.id_comentario)}" class="borrar"> Borrar </button>
                    
                    {/literal}
                {/if}
                    {literal}
                </a>
            </ul>
    </div>
    {/literal}
    {if $nombreUsuario}
    {literal}
    <div class="col-12">
        <h4 class="mb-0 card-header">Agrega tu comentario</h4>
        <br>
        <input type="text" name="" id="texto-comentario" class="form-control tamaño-comentario" placeholder="El producto me pareció... ">
        <label for="">Puntaje</label>
        <select name="" class="custom-select" id="puntaje-comentario">
            <option selected value="5"> Puntue el producto </option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <button class="btn btn-success btn-block" @click="agregarComentario">Agregar</button>
    </div>
    {/literal}
    {/if}
    {literal}
       
        
</section>
{/literal}