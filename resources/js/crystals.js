import Swal from "sweetalert2";

// --- HELPERS ---

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function showFormErrors(errors, formType) {
    const errorContainer =
        formType === "create"
            ? document.getElementById("createFormErrors")
            : document.getElementById("editFormErrors");
    const errorList =
        formType === "create"
            ? document.getElementById("createErrorList")
            : document.getElementById("editErrorList");

    errorList.innerHTML = "";

    Object.values(errors).forEach((errorArray) => {
        errorArray.forEach((error) => {
            const li = document.createElement("li");
            li.textContent = error;
            errorList.appendChild(li);
        });
    });

    errorContainer.classList.remove("hidden");
}

function hideFormErrors(formType) {
    const errorContainer =
        formType === "create"
            ? document.getElementById("createFormErrors")
            : document.getElementById("editFormErrors");
    if (errorContainer) errorContainer.classList.add("hidden");
}

// --- MODAL LOGIC ---

window.openCreateModal = function () {
    const modal = document.getElementById("createCrystalModal");
    const backdrop = document.getElementById("createCrystalBackdrop");
    const panel = document.getElementById("createCrystalPanel");
    const form = document.getElementById("createCrystalForm");

    if (form) form.reset();
    hideFormErrors("create");

    modal.classList.remove("hidden");
    setTimeout(() => {
        backdrop.classList.remove("opacity-0");
        backdrop.classList.add("opacity-100");
        panel.classList.remove("opacity-0", "scale-95");
        panel.classList.add("opacity-100", "scale-100");
    }, 10);
};

window.closeCreateModal = function () {
    const modal = document.getElementById("createCrystalModal");
    const backdrop = document.getElementById("createCrystalBackdrop");
    const panel = document.getElementById("createCrystalPanel");

    backdrop.classList.remove("opacity-100");
    backdrop.classList.add("opacity-0");
    panel.classList.remove("opacity-100", "scale-100");
    panel.classList.add("opacity-0", "scale-95");

    setTimeout(() => {
        modal.classList.add("hidden");
    }, 300);
};

window.editCrystal = function (crystal) {
    const modal = document.getElementById("editCrystalModal");
    const backdrop = document.getElementById("editCrystalBackdrop");
    const panel = document.getElementById("editCrystalPanel");

    document.getElementById("edit_crystal_id").value = crystal.id;
    document.getElementById("edit_name").value = crystal.name;
    document.getElementById("edit_price").value = crystal.price;

    hideFormErrors("edit");

    modal.classList.remove("hidden");
    setTimeout(() => {
        backdrop.classList.remove("opacity-0");
        backdrop.classList.add("opacity-100");
        panel.classList.remove("opacity-0", "scale-95");
        panel.classList.add("opacity-100", "scale-100");
    }, 10);
};

window.closeEditModal = function () {
    const modal = document.getElementById("editCrystalModal");
    const backdrop = document.getElementById("editCrystalBackdrop");
    const panel = document.getElementById("editCrystalPanel");

    backdrop.classList.remove("opacity-100");
    backdrop.classList.add("opacity-0");
    panel.classList.remove("opacity-100", "scale-100");
    panel.classList.add("opacity-0", "scale-95");

    setTimeout(() => {
        modal.classList.add("hidden");
    }, 300);
};

// --- CORE AJAX FUNCTIONS ---

// Función centralizada para obtener datos
function fetchData(url) {
    fetch(url, {
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            Accept: "application/json",
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                updateCrystalTable(data.crystals.data);
                const paginationContainer = document.getElementById(
                    "paginationContainer"
                );
                if (paginationContainer && data.pagination) {
                    paginationContainer.innerHTML = data.pagination;
                }
            }
        })
        .catch((error) => console.error("Error fetching data:", error));
}

// Función de búsqueda (usada por el input y para refrescar la tabla)
const searchCrystals = debounce(function (searchTerm) {
    // Usamos la ubicación actual para evitar problemas de rutas hardcodeadas
    const url = new URL(window.location.origin + window.location.pathname);

    if (searchTerm) {
        url.searchParams.append("search", searchTerm);
    }

    // Actualizamos la URL del navegador sin recargar
    window.history.pushState({}, "", url);

    fetchData(url);
}, 300);

// Refrescar tabla (útil después de crear/editar/borrar) mantiene la búsqueda actual
function refreshTable() {
    const searchInput = document.getElementById("crystalsSearchInput");
    const currentSearch = searchInput ? searchInput.value : "";
    // Llamamos a searchCrystals inmediatamente sin debounce para actualización instantánea
    const url = new URL(window.location.origin + window.location.pathname);
    if (currentSearch) url.searchParams.append("search", currentSearch);
    fetchData(url);
}

function updateCrystalTable(crystals) {
    const tbody = document.getElementById("crystalsTableBody");
    tbody.innerHTML = "";

    if (crystals.length === 0) {
        tbody.innerHTML = `  
            <tr>  
                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">  
                    No crystals found.  
                </td>  
            </tr>  
        `;
        return;
    }

    crystals.forEach((crystal) => {
        const row = document.createElement("tr");
        row.setAttribute("data-crystal-id", crystal.id);

        // Convertimos el objeto crystal a string seguro para HTML
        const crystalJson = JSON.stringify(crystal).replace(/"/g, "&quot;");

        row.innerHTML = `  
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${
                crystal.id
            }</td>  
            <td class="px-6 py-4 whitespace-nowrap">  
                <div class="text-sm font-medium text-gray-900">${
                    crystal.name
                }</div>  
            </td>  
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$ ${parseFloat(
                crystal.price
            ).toFixed(2)}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">  
                <div class="flex gap-2">  
                    <button onclick="editCrystal(${crystalJson})"   
                        class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-md transition-colors duration-150">  
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">  
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>  
                        </svg>  
                        Edit  
                    </button>  
                    <button onclick="deleteCrystal(${crystal.id})"   
                        class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-md transition-colors duration-150">  
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">  
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>  
                        </svg>  
                        Delete  
                    </button>  
                </div>  
            </td>  
        `;
        tbody.appendChild(row);
    });
}

// --- ACTIONS (DELETE) ---

window.deleteCrystal = function (id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/crystals/${id}`, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": window.csrfToken,
                    Accept: "application/json",
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "success",
                            title: "Deleted!",
                            showConfirmButton: false,
                            timer: 1000,
                        });
                        // Refrescamos la tabla manteniendo paginación/búsqueda actual si es posible
                        refreshTable();
                    } else {
                        Swal.fire("Error!", data.message, "error");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    Swal.fire("Error!", "Error deleting crystal.", "error");
                });
        }
    });
};

// --- INITIALIZATION ---

document.addEventListener("DOMContentLoaded", function () {
    // 1. Configurar Paginación (Delegación de eventos)
    document.addEventListener("click", function (e) {
        const link = e.target.closest("#paginationContainer a");
        if (link) {
            e.preventDefault();
            // Fetch a la URL generada por Laravel (que ya incluye ?page=X&search=Y)
            fetchData(link.href);
            // Actualizar URL del navegador
            window.history.pushState({}, "", link.href);
        }
    });

    // 2. Configurar Buscador
    const crystalsSearchInput = document.getElementById("crystalsSearchInput");
    if (crystalsSearchInput) {
        // Recuperar valor de la URL si refrescamos la página
        const params = new URLSearchParams(window.location.search);
        if (params.has("search")) {
            crystalsSearchInput.value = params.get("search");
        }

        crystalsSearchInput.addEventListener("input", function (e) {
            searchCrystals(e.target.value);
        });
    }

    // 3. Crear Crystal Form
    const createCrystalBtn = document.getElementById("createCrystalBtn");
    if (createCrystalBtn) {
        createCrystalBtn.addEventListener("click", openCreateModal);
    }

    const createCrystalForm = document.getElementById("createCrystalForm");
    if (createCrystalForm) {
        createCrystalForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const submitBtn = document.getElementById("createSubmitBtn");
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = "Creating...";
            hideFormErrors("create");

            const formData = new FormData(this);

            fetch("/crystals", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": window.csrfToken,
                    Accept: "application/json",
                },
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "success",
                            title: "Success!",
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1000,
                        });
                        closeCreateModal();
                        createCrystalForm.reset();
                        // AQUÍ EL CAMBIO: No recargamos la página, refrescamos la tabla AJAX
                        refreshTable();
                    } else {
                        if (data.errors) showFormErrors(data.errors, "create");
                        else
                            Swal.fire(
                                "Error!",
                                data.message || "Error creating crystal.",
                                "error"
                            );
                    }
                })
                .catch((error) =>
                    Swal.fire("Error!", "Error creating crystal.", "error")
                )
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                });
        });
    }

    // 4. Edit Crystal Form
    const editCrystalForm = document.getElementById("editCrystalForm");
    if (editCrystalForm) {
        editCrystalForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const submitBtn = document.getElementById("editSubmitBtn");
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = "Updating...";
            hideFormErrors("edit");

            const crystalId = document.getElementById("edit_crystal_id").value;
            const formData = new FormData(this);

            fetch(`/crystals/${crystalId}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": window.csrfToken,
                    Accept: "application/json",
                    "X-HTTP-Method-Override": "PUT",
                },
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "success",
                            title: "Updated!",
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1000,
                        });
                        closeEditModal();
                        // AQUÍ EL CAMBIO: Refrescamos la tabla AJAX
                        refreshTable();
                    } else {
                        if (data.errors) showFormErrors(data.errors, "edit");
                        else
                            Swal.fire(
                                "Error!",
                                data.message || "Error updating crystal.",
                                "error"
                            );
                    }
                })
                .catch((error) =>
                    Swal.fire("Error!", "Error updating crystal.", "error")
                )
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                });
        });
    }
});
