import Swal from "sweetalert2";

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

// Show message helper
function showMessage(message, type = "success") {
    const messageContainer = document.getElementById("messageContainer");
    const messageContent = document.getElementById("messageContent");

    messageContainer.classList.remove("hidden");
    messageContent.className = `rounded-md p-4 ${type === "success"
            ? "bg-green-100 border border-green-400 text-green-700"
            : "bg-red-100 border border-red-400 text-red-700"
        }`;
    messageContent.textContent = message;

    setTimeout(() => {
        messageContainer.classList.add("hidden");
    }, 5000);
}

// Error handling
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
    errorContainer.classList.add("hidden");
}

// --- Create Modal ---
window.openCreateModal = function () {
    const modal = document.getElementById("createPaymentMethodModal");
    const backdrop = document.getElementById("createPaymentMethodBackdrop");
    const panel = document.getElementById("createPaymentMethodPanel");
    const form = document.getElementById("createPaymentMethodForm");

    form.reset();
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
    const modal = document.getElementById("createPaymentMethodModal");
    const backdrop = document.getElementById("createPaymentMethodBackdrop");
    const panel = document.getElementById("createPaymentMethodPanel");

    backdrop.classList.remove("opacity-100");
    backdrop.classList.add("opacity-0");
    panel.classList.remove("opacity-100", "scale-100");
    panel.classList.add("opacity-0", "scale-95");

    setTimeout(() => {
        modal.classList.add("hidden");
    }, 300);
};

// --- Edit Modal ---
window.editPaymentMethod = function (paymentMethod) {
    const modal = document.getElementById("editPaymentMethodModal");
    const backdrop = document.getElementById("editPaymentMethodBackdrop");
    const panel = document.getElementById("editPaymentMethodPanel");

    document.getElementById("edit_payment_method_id").value = paymentMethod.id;
    document.getElementById("edit_name").value = paymentMethod.name;
    document.getElementById("edit_is_usd").checked = paymentMethod.is_usd;

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
    const modal = document.getElementById("editPaymentMethodModal");
    const backdrop = document.getElementById("editPaymentMethodBackdrop");
    const panel = document.getElementById("editPaymentMethodPanel");

    backdrop.classList.remove("opacity-100");
    backdrop.classList.add("opacity-0");
    panel.classList.remove("opacity-100", "scale-100");
    panel.classList.add("opacity-0", "scale-95");

    setTimeout(() => {
        modal.classList.add("hidden");
    }, 300);
};

// --- Delete ---
window.deletePaymentMethod = function (id) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esta acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminarlo!",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/payment-methods/${id}`, {
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
                            title: "¡Eliminado!",
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1000,
                        });
                        const row = document.querySelector(`tr[data-id="${id}"]`);
                        if (row) row.remove();
                        // reload is safest to handle pagination/empty state perfectly without complexity
                        setTimeout(() => window.location.reload(), 1000);
                    } else {
                        Swal.fire("Error!", data.message, "error");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    Swal.fire("Error!", "Error al eliminar.", "error");
                });
        }
    });
};

// --- Search ---
const searchPaymentMethods = debounce(function (searchTerm) {
    const url = new URL("/payment-methods", window.location.origin);
    if (searchTerm) {
        url.searchParams.append("search", searchTerm);
    }

    fetch(url, {
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            Accept: "application/json",
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                updateTable(data.paymentMethods.data);
                if (data.pagination) {
                    document.getElementById("paginationContainer").innerHTML = data.pagination;
                }
            }
        })
        .catch((error) => console.error("Error:", error));
}, 300);

function updateTable(paymentMethods) {
    const tbody = document.getElementById("tableBody");
    tbody.innerHTML = "";

    if (paymentMethods.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                    No se encontraron métodos de pago.
                </td>
            </tr>
        `;
        return;
    }

    paymentMethods.forEach((method) => {
        const createdDate = new Date(method.created_at);
        const formattedDate = createdDate.toLocaleDateString("es-ES", {
            day: "2-digit",
            month: "2-digit",
            year: "numeric",
            hour: "2-digit",
            minute: "2-digit",
            hour12: true,
        });

        const currencyBadge = method.is_usd
            ? `<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Dólares (USD)</span>`
            : `<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Bolívares (VES)</span>`;

        const row = document.createElement("tr");
        row.setAttribute("data-id", method.id);
        row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">${method.name}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                ${currencyBadge}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                ${formattedDate}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <div class="flex gap-2">
                    <button onclick='editPaymentMethod(${JSON.stringify(method)})' 
                        class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-md transition-colors duration-150">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Editar
                    </button>
                    <button onclick="deletePaymentMethod(${method.id})" 
                        class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-md transition-colors duration-150">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Eliminar
                    </button>
                </div>
            </td>
        `;
        tbody.appendChild(row);
    });
}

// --- Init & Event Listeners ---
document.addEventListener("DOMContentLoaded", function () {
    const createBtn = document.getElementById("createPaymentMethodBtn");
    if (createBtn) {
        createBtn.addEventListener("click", openCreateModal);
    }

    // Create Form Submit
    const createForm = document.getElementById("createPaymentMethodForm");
    if (createForm) {
        createForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const submitBtn = document.getElementById("createSubmitBtn");
            submitBtn.disabled = true;
            submitBtn.textContent = "Guardando...";
            hideFormErrors("create");

            const formData = new FormData(this);

            fetch("/payment-methods", {
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
                            title: "Creado!",
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1000,
                        });
                        closeCreateModal();
                        setTimeout(() => window.location.reload(), 1000);
                    } else {
                        if (data.errors) {
                            showFormErrors(data.errors, "create");
                        } else {
                            Swal.fire("Error!", data.message || "Error al crear.", "error");
                        }
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    showMessage("Error al crear.", "error");
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = "Guardar";
                });
        });
    }

    // Edit Form Submit
    const editForm = document.getElementById("editPaymentMethodForm");
    if (editForm) {
        editForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const id = document.getElementById("edit_payment_method_id").value;
            const submitBtn = document.getElementById("editSubmitBtn");
            submitBtn.disabled = true;
            submitBtn.textContent = "Actualizando...";
            hideFormErrors("edit");

            const formData = new FormData(this);
            // Convert to JSON or use _method PUT for Laravel
            const data = {};
            formData.forEach((value, key) => (data[key] = value));
            // Checkbox handling for boolean
            data['is_usd'] = document.getElementById('edit_is_usd').checked ? 1 : 0;

            fetch(`/payment-methods/${id}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": window.csrfToken,
                    Accept: "application/json",
                },
                body: JSON.stringify(data),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "success",
                            title: "Actualizado!",
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1000,
                        });
                        closeEditModal();
                        setTimeout(() => window.location.reload(), 1000);
                    } else {
                        if (data.errors) {
                            showFormErrors(data.errors, "edit");
                        } else {
                            Swal.fire("Error!", data.message || "Error al actualizar.", "error");
                        }
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    showMessage("Error al actualizar.", "error");
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = "Actualizar";
                });
        });
    }

    // Search
    const searchInput = document.getElementById("searchInput");
    if (searchInput) {
        searchInput.addEventListener("input", (e) => searchPaymentMethods(e.target.value));
    }
});
