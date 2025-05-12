import{a as g}from"./index-xsH4HHeE.js";const l=document.querySelector("#formulario"),a=document.querySelector("#resultado"),n=document.querySelector("#paginacion"),c=40;let i,s,d,u=1;window.onload=()=>{l.addEventListener("submit",h)};function h(e){if(e.preventDefault(),i=document.querySelector("#termino").value.trim(),i===""){y("Agrega un término de busqueda"),$();return}m()}async function m(){const t=`https://pixabay.com/api/?key=45791498-a05fbafcc7709e81d43f95a7f&q=${i}&per_page=${c}&page=${u}`;try{const o=(await g.get(t)).data;d=b(o.totalHits),w(o.hits)}catch(r){console.error("Error al obtener imágenes:",r)}}function w(e){for(;a.firstChild;)a.firstChild.remove();for(e.forEach(t=>{const{previewURL:r,likes:o,views:f,largeImageURL:p}=t;a.innerHTML+=`
        <div class="col-6 col-md-4 col-lg-3 mb-4 px-2">
          <div class="bg-white shadow-sm rounded overflow-hidden h-100 d-flex flex-column">
            <img src="${r}" class="img-fluid w-100 m-h-200" />

            <div class="p-3 flex-grow-1 d-flex flex-column justify-content-between">
              <div>
                <p class="fw-bold mb-2">
                  ${o} 
                  <span class="fw-light">Me Gusta</span>
                </p>

                <p class="fw-bold">
                  ${f} 
                  <span class="fw-light">Veces vista</span>
                </p>
              </div>

              <a
                href="${p}"
                target="_blank"
                rel="noopener noreferrer"
                class="btn btn-primary text-uppercase fw-bold w-100 mt-3"
              >
                Ver Imagen HD
              </a>
            </div>
          </div>
        </div>
    `});n.firstChild;)n.firstChild.remove();x()}function b(e){return parseInt(Math.ceil(e/c))}function*v(e){for(let t=1;t<=e;t++)yield t}function x(){for(s=v(d);;){const{value:e,done:t}=s.next();if(t)return;const r=document.createElement("a");r.href="#",r.dataset.pagina=e,r.textContent=e,r.classList.add("btn","btn-secondary","fw-bold","mb-1","me-2","px-3","py-1","rounded","text-uppercase","siguiente"),r.onclick=()=>{u=e,m()},n.appendChild(r)}}function y(e){var r;(r=document.querySelector(".alerta"))==null||r.remove();const t=document.createElement("p");t.classList.add("alert","alert-danger","px-4","py-3","rounded","w-100","mt-3","text-center"),t.innerHTML=`
        <strong class="fw-bold">Error!</strong>
        <span class="d-block">${e}</span>
    `,l.appendChild(t),setTimeout(()=>{t.remove()},2500)}function $(){for(;a.firstChild;)a.firstChild.remove();for(;n.firstChild;)n.firstChild.remove()}
