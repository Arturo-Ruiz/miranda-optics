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

// Show message
function showMessage(message, type = "success") {
    const messageContainer = document.getElementById("messageContainer");
    const messageContent = document.getElementById("messageContent");

    messageContainer.classList.remove("hidden");
    messageContent.className = `rounded-md p-4 ${
        type === "success"
            ? "bg-green-100 border border-green-400 text-green-700"
            : "bg-red-100 border border-red-400 text-red-700"
    }`;
    messageContent.textContent = message;

    setTimeout(() => {
        messageContainer.classList.add("hidden");
    }, 5000);
}

// Show form errors
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

// Hide form errors
function hideFormErrors(formType) {
    const errorContainer =
        formType === "create"
            ? document.getElementById("createFormErrors")
            : document.getElementById("editFormErrors");
    errorContainer.classList.add("hidden");
}

// Open create modal with animation
window.openCreateModal = function () {
    const modal = document.getElementById("createCrystalModal");
    const backdrop = document.getElementById("createCrystalBackdrop");
    const panel = document.getElementById("createCrystalPanel");
    const form = document.getElementById("createCrystalForm");

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

// Close create modal with animation
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

// Edit crystal
window.editCrystal = function (crystal) {
    const modal = document.getElementById("editCrystalModal");
    const backdrop = document.getElementById("editCrystalBackdrop");
    const panel = document.getElementById("editCrystalPanel");

    // Fill form data
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

// Close edit modal with animation
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

// Delete crystal
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
                            text: 'Crystal has been deleted.',
                            showConfirmButton: false,
                            timer: 1000,
                        });

                        const row = document.querySelector(
                            `tr[data-crystal-id="${id}"]`
                        );
                        if (row) {
                            row.remove();
                        }

                        const tbody =
                            document.getElementById("crystalsTableBody");
                        if (tbody.children.length === 0) {
                            tbody.innerHTML = `  
                            <tr>  
                                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">  
                                    No crystals found.  
                                </td>  
                            </tr>  
                        `;
                        }
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

// Search crystals
const searchCrystals = debounce(function (searchTerm) {
    const url = new URL("/crystals", window.location.origin);
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
                updateCrystalTable(data.crystals.data);
                if (data.pagination) {
                    document.getElementById("paginationContainer").innerHTML =
                        data.pagination;
                }
            }
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}, 300);

// Handle pagination clicks
document.addEventListener("click", function (e) {
    const link = e.target.closest("#paginationContainer a");
    if (link) {
        e.preventDefault();

        fetch(link.href, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                Accept: "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    updateCrystalTable(data.crystals.data);
                    if (data.pagination) {
                        document.getElementById(
                            "paginationContainer"
                        ).innerHTML = data.pagination;
                    }
                    // Update browser URL
                    window.history.pushState({}, "", link.href);
                }
            })
            .catch((error) => console.error("Error:", error));
    }
});

// Update crystal table
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
                    <button onclick='editCrystal(${JSON.stringify(crystal)})'   
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

// Initialize when DOM is ready
document.addEventListener("DOMContentLoaded", function () {
    // Create crystal button
    const createCrystalBtn = document.getElementById("createCrystalBtn");
    if (createCrystalBtn) {
        createCrystalBtn.addEventListener("click", openCreateModal);
    }

    // Create crystal form submit
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
                        setTimeout(() => window.location.reload(), 1000);
                    } else {
                        if (data.errors) {
                            showFormErrors(data.errors, "create");
                        } else {
                            Swal.fire(
                                "Error!",
                                data.message || "Error creating crystal.",
                                "error"
                            );
                        }
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    Swal.fire("Error!", "Error creating crystal.", "error");
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                });
        });
    }

    // Edit crystal form submit
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
                        setTimeout(() => window.location.reload(), 1000);
                    } else {
                        if (data.errors) {
                            showFormErrors(data.errors, "edit");
                        } else {
                            Swal.fire(
                                "Error!",
                                data.message || "Error updating crystal.",
                                "error"
                            );
                        }
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    Swal.fire("Error!", "Error updating crystal.", "error");
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                });
        });
    }

    // Search input
    const crystalsSearchInput = document.getElementById("crystalsSearchInput");
    if (crystalsSearchInput) {
        crystalsSearchInput.addEventListener("input", function (e) {
            searchCrystals(e.target.value);
        });
    }
});
