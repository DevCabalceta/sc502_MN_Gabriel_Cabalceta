const wishForm = document.getElementById("wishForm");
const wishInput = document.getElementById("wishInput");
const wishList = document.getElementById("wishList");

// Enlistar
async function loadWishes() {
  wishList.innerHTML = "";
  try {
    const response = await fetch("api.php");
    const wishes = await response.json();

    if (wishes.length === 0) {
      const empty = document.createElement("li");
      empty.className = "list-group-item text-muted text-center";
      empty.textContent = "No hay deseos agregados.";
      wishList.appendChild(empty);
      return;
    }

    wishes.forEach((wish) => {
      const li = document.createElement("li");
      li.className =
        "list-group-item d-flex justify-content-between align-items-start flex-column flex-sm-row";
      li.innerHTML = `
        <div>
          <strong>${wish.descripcion}</strong><br>
          <small class="text-muted">Agregado el: ${new Date(wish.fecha).toLocaleString("es-ES")}</small>
        </div>
        <div class="d-flex gap-2 mt-2 mt-sm-0">
          <button class="btn btn-sm btn-outline-secondary" onclick="editWish(${wish.id}, '${wish.descripcion.replace(/'/g, "\\'")}')">Editar</button>
          <button class="btn btn-sm btn-outline-danger" onclick="deleteWish(${wish.id})">Eliminar</button>
        </div>


      `;
      wishList.appendChild(li);
    });
  } catch (error) {
    console.error("Error al cargar deseos:", error);
  }
}

// Agregar
wishForm.addEventListener("submit", async function (e) {
  e.preventDefault();
  const descripcion = wishInput.value.trim();

  if (descripcion !== "") {
    await fetch("api.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ descripcion }),
    });

    wishInput.value = "";
    loadWishes();
  }
});

// Eliminar
async function deleteWish(id) {
  await fetch("api.php", {
    method: "DELETE",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `id=${id}`,
  });

  loadWishes();
}


loadWishes();

let modalInstance;

function editWish(id, descripcion) {
  document.getElementById("editId").value = id;
  document.getElementById("editDescripcion").value = descripcion;

  const modal = new bootstrap.Modal(document.getElementById("editarModal"));
  modalInstance = modal;
  modal.show();
}


function guardarEdicion() {
  const id = document.getElementById("editId").value;
  const nueva = document.getElementById("editDescripcion").value.trim();

  if (nueva !== "") {
    fetch("api.php", {
      method: "PUT",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `id=${id}&descripcion=${encodeURIComponent(nueva)}`,
    })
    .then(() => {
      loadWishes();
      modalInstance.hide();
    })
    .catch((err) => console.error("Error al actualizar:", err));
  }
}


