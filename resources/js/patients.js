// Patients Management JavaScript
import Swal from "sweetalert2";

// Import helper functions from users.js
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

// Tab switching for create modal
window.switchTab = function (tab) {
    const personalTab = document.getElementById("personalTab");
    const formulaTab = document.getElementById("formulaTab");
    const personalContent = document.getElementById("personalTabContent");
    const formulaContent = document.getElementById("formulaTabContent");

    if (tab === "personal") {
        personalTab.classList.add("active", "border-blue-500", "text-blue-600");
        personalTab.classList.remove("border-transparent", "text-gray-500");
        formulaTab.classList.remove(
            "active",
            "border-blue-500",
            "text-blue-600"
        );
        formulaTab.classList.add("border-transparent", "text-gray-500");
        personalContent.classList.remove("hidden");
        formulaContent.classList.add("hidden");
    } else {
        formulaTab.classList.add("active", "border-blue-500", "text-blue-600");
        formulaTab.classList.remove("border-transparent", "text-gray-500");
        personalTab.classList.remove(
            "active",
            "border-blue-500",
            "text-blue-600"
        );
        personalTab.classList.add("border-transparent", "text-gray-500");
        formulaContent.classList.remove("hidden");
        personalContent.classList.add("hidden");
    }
};

// Tab switching for edit modal
window.switchEditTab = function (tab) {
    const personalTab = document.getElementById("editPersonalTab");
    const formulaTab = document.getElementById("editFormulaTab");
    const personalContent = document.getElementById("editPersonalTabContent");
    const formulaContent = document.getElementById("editFormulaTabContent");

    if (tab === "personal") {
        personalTab.classList.add("active", "border-blue-500", "text-blue-600");
        personalTab.classList.remove("border-transparent", "text-gray-500");
        formulaTab.classList.remove(
            "active",
            "border-blue-500",
            "text-blue-600"
        );
        formulaTab.classList.add("border-transparent", "text-gray-500");
        personalContent.classList.remove("hidden");
        formulaContent.classList.add("hidden");
    } else {
        formulaTab.classList.add("active", "border-blue-500", "text-blue-600");
        formulaTab.classList.remove("border-transparent", "text-gray-500");
        personalTab.classList.remove(
            "active",
            "border-blue-500",
            "text-blue-600"
        );
        personalTab.classList.add("border-transparent", "text-gray-500");
        formulaContent.classList.remove("hidden");
        personalContent.classList.add("hidden");
    }
};

// Open create modal with animation
window.openCreateModal = function () {
    const modal = document.getElementById("createPatientModal");
    const backdrop = document.getElementById("createPatientBackdrop");
    const panel = document.getElementById("createPatientPanel");
    const form = document.getElementById("createPatientForm");

    form.reset();
    hideFormErrors("create");
    switchTab("personal");

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
    const modal = document.getElementById("createPatientModal");
    const backdrop = document.getElementById("createPatientBackdrop");
    const panel = document.getElementById("createPatientPanel");

    backdrop.classList.remove("opacity-100");
    backdrop.classList.add("opacity-0");
    panel.classList.remove("opacity-100", "scale-100");
    panel.classList.add("opacity-0", "scale-95");

    setTimeout(() => {
        modal.classList.add("hidden");
    }, 300);
};

//Edit patient
window.editPatient = function (patient) {
    const modal = document.getElementById("editPatientModal");
    const backdrop = document.getElementById("editPatientBackdrop");
    const panel = document.getElementById("editPatientPanel");

    // Fill personal data
    document.getElementById("edit_patient_id").value = patient.id;
    document.getElementById("edit_first_name").value = patient.first_name;
    document.getElementById("edit_last_name").value = patient.last_name;
    document.getElementById("edit_age").value = patient.age;
    document.getElementById("edit_id_card").value = patient.id_card;
    document.getElementById("edit_occupation").value = patient.occupation || "";

    // Strip +58 prefix from phone for display
    let phoneNumber = patient.phone;
    if (phoneNumber.startsWith("+58")) {
        phoneNumber = phoneNumber.substring(3);
    }
    document.getElementById("edit_phone").value = phoneNumber;

    // Fill optical formula if exists
    if (patient.optical_formula) {
        fillFormulaFields(patient.optical_formula, "edit");
    }

    hideFormErrors("edit");
    switchEditTab("personal");

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
    const modal = document.getElementById("editPatientModal");
    const backdrop = document.getElementById("editPatientBackdrop");
    const panel = document.getElementById("editPatientPanel");

    backdrop.classList.remove("opacity-100");
    backdrop.classList.add("opacity-0");
    panel.classList.remove("opacity-100", "scale-100");
    panel.classList.add("opacity-0", "scale-95");

    setTimeout(() => {
        modal.classList.add("hidden");
    }, 300);
};

// View formula
window.viewFormula = function (patientId) {
    fetch(`/patients/${patientId}`)
        .then((response) => response.json())
        .then((data) => {
            if (data.success && data.patient.optical_formula) {
                displayFormula(data.patient);

                const modal = document.getElementById("viewFormulaModal");
                const backdrop = document.getElementById("viewFormulaBackdrop");
                const panel = document.getElementById("viewFormulaPanel");

                modal.classList.remove("hidden");

                setTimeout(() => {
                    backdrop.classList.remove("opacity-0");
                    backdrop.classList.add("opacity-100");
                    panel.classList.remove("opacity-0", "scale-95");
                    panel.classList.add("opacity-100", "scale-100");
                }, 10);
            } else {
                Swal.fire(
                    "Info",
                    "Este paciente no tiene fórmula óptica registrada.",
                    "info"
                );
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            showMessage("Error al cargar la fórmula óptica.", "error");
        });
};

// Close view formula modal
window.closeViewFormulaModal = function () {
    const modal = document.getElementById("viewFormulaModal");
    const backdrop = document.getElementById("viewFormulaBackdrop");
    const panel = document.getElementById("viewFormulaPanel");

    backdrop.classList.remove("opacity-100");
    backdrop.classList.add("opacity-0");
    panel.classList.remove("opacity-100", "scale-100");
    panel.classList.add("opacity-0", "scale-95");

    setTimeout(() => {
        modal.classList.add("hidden");
    }, 300);
};

// Display formula in view modal
function displayFormula(patient) {
    const container = document.getElementById("formulaContent");
    const formula = patient.optical_formula;

    let html = `
        <div>
            <h4 class="font-semibold text-gray-900 mb-2">Paciente: ${patient.first_name} ${patient.last_name}</h4>
        </div>
    `;

    if (formula.formula) {
        html += `
            <div>
                <h5 class="font-medium text-gray-700 mb-2">Fórmula</h5>
                <table class="min-w-full border border-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 py-2 border border-gray-300 text-xs font-medium">  </th>
                            <th class="px-3 py-2 border border-gray-300 text-xs font-medium">ESF</th>
                            <th class="px-3 py-2 border border-gray-300 text-xs font-medium">CIL</th>
                            <th class="px-3 py-2 border border-gray-300 text-xs font-medium">EJE</th>
                            <th class="px-3 py-2 border border-gray-300 text-xs font-medium">ADD</th>
                            <th class="px-3 py-2 border border-gray-300 text-xs font-medium">DPN</th>
                            <th class="px-3 py-2 border border-gray-300 text-xs font-medium">ALT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-3 py-2 border border-gray-300 font-medium">OD</td>
                            <td class="px-3 py-2 border border-gray-300">${
                                formula.formula.od?.esf || "-"
                            }</td>
                            <td class="px-3 py-2 border border-gray-300">${
                                formula.formula.od?.cil || "-"
                            }</td>
                            <td class="px-3 py-2 border border-gray-300">${
                                formula.formula.od?.eje || "-"
                            }</td>
                            <td class="px-3 py-2 border border-gray-300">${
                                formula.formula.od?.add || "-"
                            }</td>
                            <td class="px-3 py-2 border border-gray-300">${
                                formula.formula.od?.dpn || "-"
                            }</td>
                            <td class="px-3 py-2 border border-gray-300">${
                                formula.formula.od?.alt || "-"
                            }</td>
                        </tr>
                        <tr>
                            <td class="px-3 py-2 border border-gray-300 font-medium">OI</td>
                            <td class="px-3 py-2 border border-gray-300">${
                                formula.formula.oi?.esf || "-"
                            }</td>
                            <td class="px-3 py-2 border border-gray-300">${
                                formula.formula.oi?.cil || "-"
                            }</td>
                            <td class="px-3 py-2 border border-gray-300">${
                                formula.formula.oi?.eje || "-"
                            }</td>
                            <td class="px-3 py-2 border border-gray-300">${
                                formula.formula.oi?.add || "-"
                            }</td>
                            <td class="px-3 py-2 border border-gray-300">${
                                formula.formula.oi?.dpn || "-"
                            }</td>
                            <td class="px-3 py-2 border border-gray-300">${
                                formula.formula.oi?.alt || "-"
                            }</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        `;
    }

    if (formula.options) {
        const activeOptions = Object.keys(formula.options).filter(
            (key) => formula.options[key]
        );
        if (activeOptions.length > 0) {
            html += `
                <div>
                    <h5 class="font-medium text-gray-700 mb-2">Opciones</h5>
                    <div class="flex flex-wrap gap-2">
                        ${activeOptions
                            .map(
                                (opt) =>
                                    `<span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">${opt
                                        .toUpperCase()
                                        .replace("_", " ")}</span>`
                            )
                            .join("")}
                    </div>
                </div>
            `;
        }
    }

    if (formula.vision_lejana || formula.vision_cercana) {
        html += `<div class="grid grid-cols-2 gap-4">`;

        if (formula.vision_lejana) {
            html += `
                <div>
                    <h5 class="font-medium text-gray-700 mb-2">Visión Lejana</h5>
                    <table class="w-full border border-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 py-2 border border-gray-300 text-xs font-medium"></th>
                                <th class="px-3 py-2 border border-gray-300 text-xs font-medium">AV.SC</th>
                                <th class="px-3 py-2 border border-gray-300 text-xs font-medium">AV.CC</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-3 py-2 border border-gray-300 font-medium">OD</td>
                                <td class="px-3 py-2 border border-gray-300">${
                                    formula.vision_lejana.od?.av_sc || "-"
                                }</td>
                                <td class="px-3 py-2 border border-gray-300">${
                                    formula.vision_lejana.od?.av_cc || "-"
                                }</td>
                            </tr>
                            <tr>
                                <td class="px-3 py-2 border border-gray-300 font-medium">OI</td>
                                <td class="px-3 py-2 border border-gray-300">${
                                    formula.vision_lejana.oi?.av_sc || "-"
                                }</td>
                                <td class="px-3 py-2 border border-gray-300">${
                                    formula.vision_lejana.oi?.av_cc || "-"
                                }</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            `;
        }

        if (formula.vision_cercana) {
            html += `
                <div>
                    <h5 class="font-medium text-gray-700 mb-2">Visión Cercana</h5>
                    <table class="w-full border border-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 py-2 border border-gray-300 text-xs font-medium"></th>
                                <th class="px-3 py-2 border border-gray-300 text-xs font-medium">AV.SC</th>
                                <th class="px-3 py-2 border border-gray-300 text-xs font-medium">AV.CC</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-3 py-2 border border-gray-300 font-medium">OD</td>
                                <td class="px-3 py-2 border border-gray-300">${
                                    formula.vision_cercana.od?.av_sc || "-"
                                }</td>
                                <td class="px-3 py-2 border border-gray-300">${
                                    formula.vision_cercana.od?.av_cc || "-"
                                }</td>
                            </tr>
                            <tr>
                                <td class="px-3 py-2 border border-gray-300 font-medium">OI</td>
                                <td class="px-3 py-2 border border-gray-300">${
                                    formula.vision_cercana.oi?.av_sc || "-"
                                }</td>
                                <td class="px-3 py-2 border border-gray-300">${
                                    formula.vision_cercana.oi?.av_cc || "-"
                                }</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            `;
        }

        html += `</div>`;
    }

    if (formula.observation) {
        html += `
            <div>
                <h5 class="font-medium text-gray-700 mb-2">Observación</h5>
                <p class="text-sm text-gray-600">${formula.observation}</p>
            </div>
        `;
    }

    container.innerHTML = html;
}

// Fill formula fields in edit modal
function fillFormulaFields(formula, prefix) {
    const form = document.getElementById(`${prefix}PatientForm`);

    if (!formula) return;

    // Fill formula table
    if (formula.formula) {
        ["od", "oi"].forEach((eye) => {
            ["esf", "cil", "eje", "add", "dpn", "alt"].forEach((field) => {
                const input = form.querySelector(
                    `input[name="optical_formula[formula][${eye}][${field}]"]`
                );
                if (
                    input &&
                    formula.formula[eye] &&
                    formula.formula[eye][field]
                ) {
                    input.value = formula.formula[eye][field];
                }
            });
        });
    }

    // Fill options
    if (formula.options) {
        Object.keys(formula.options).forEach((option) => {
            const checkbox = form.querySelector(
                `input[name="optical_formula[options][${option}]"]`
            );
            if (checkbox) {
                checkbox.checked = formula.options[option];
            }
        });
    }

    // Fill vision tables
    ["vision_lejana", "vision_cercana"].forEach((visionType) => {
        if (formula[visionType]) {
            ["od", "oi"].forEach((eye) => {
                ["av_sc", "av_cc"].forEach((field) => {
                    const input = form.querySelector(
                        `input[name="optical_formula[${visionType}][${eye}][${field}]"]`
                    );
                    if (
                        input &&
                        formula[visionType][eye] &&
                        formula[visionType][eye][field]
                    ) {
                        input.value = formula[visionType][eye][field];
                    }
                });
            });
        }
    });

    // Fill observation
    if (formula.observation) {
        const textarea = form.querySelector(
            'textarea[name="optical_formula[observation]"]'
        );
        if (textarea) {
            textarea.value = formula.observation;
        }
    }
}

// Delete patient
window.deletePatient = function (id) {
    Swal.fire({
        title: "¿Estás seguro de eliminar este paciente?",
        text: "¡No podrás revertir esta acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminarlo!",
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/patients/${id}`, {
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
                            title: "¡Paciente eliminado exitosamente!",
                            showConfirmButton: false,
                            timer: 1000,
                        });
                        const row = document.querySelector(
                            `tr[data-patient-id="${id}"]`
                        );
                        if (row) {
                            row.remove();
                        }
                        // Handle empty table logic...
                    } else {
                        Swal.fire("Error!", data.message, "error");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    Swal.fire(
                        "Error!",
                        "Error al eliminar el paciente.",
                        "error"
                    );
                });
        }
    });
};

// Search patients
const searchPatients = debounce(function (searchTerm) {
    const url = new URL("/patients", window.location.origin);
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
                updatePatientTable(data.patients.data);
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
                    updatePatientTable(data.patients.data);
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

// Update patient table
function updatePatientTable(patients) {
    const tbody = document.getElementById("patientsTableBody");
    tbody.innerHTML = "";

    if (patients.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                    No se encontraron pacientes.
                </td>
            </tr>
        `;
        return;
    }

    patients.forEach((patient) => {
        const createdDate = new Date(patient.created_at);
        const formattedCreatedDate = createdDate.toLocaleDateString("es-ES", {
            day: "2-digit",
            month: "2-digit",
            year: "numeric",
            hour: "2-digit",
            minute: "2-digit",
            hour12: true,
        });

        const updatedDate = new Date(patient.updated_at);
        const formattedUpdatedDate = updatedDate.toLocaleDateString("es-ES", {
            day: "2-digit",
            month: "2-digit",
            year: "numeric",
            hour: "2-digit",
            minute: "2-digit",
            hour12: true,
        });

        const row = document.createElement("tr");
        row.setAttribute("data-patient-id", patient.id);
        row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${
                patient.id
            }</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">${
                    patient.first_name
                } ${patient.last_name}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${
                patient.id_card
            }</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${
                patient.age
            }</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${
                patient.phone
            }</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formattedCreatedDate}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formattedUpdatedDate}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <div class="flex gap-2">
                    <a href="/patients/${patient.id}/print"
                        class="inline-flex items-center px-3 py-2 bg-purple-600 hover:bg-purple-700 text-white text-xs font-medium rounded-md transition-colors duration-150">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        PDF
                    </a>
                    <button onclick="viewFormula(${patient.id})" 
                        class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-md transition-colors duration-150">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Ver
                    </button>
                    <button onclick='editPatient(${JSON.stringify(patient)})' 
                        class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-md transition-colors duration-150">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Editar
                    </button>
                    <button onclick="deletePatient(${patient.id})" 
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

// Initialize when DOM is ready
document.addEventListener("DOMContentLoaded", function () {
    // Create patient button
    const createPatientBtn = document.getElementById("createPatientBtn");
    if (createPatientBtn) {
        createPatientBtn.addEventListener("click", openCreateModal);
    }

    // Create patient form submit
    const createPatientForm = document.getElementById("createPatientForm");
    if (createPatientForm) {
        createPatientForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const submitBtn = document.getElementById("createSubmitBtn");
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = "Creando...";

            hideFormErrors("create");

            const formData = new FormData(this);

            fetch("/patients", {
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
                        createPatientForm.reset();
                        setTimeout(() => window.location.reload(), 1000);
                    } else {
                        if (data.errors) {
                            showFormErrors(data.errors, "create");
                        } else {
                            Swal.fire(
                                "Error!",
                                data.message || "Error al crear el paciente.",
                                "error"
                            );
                        }
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    showMessage("Error al crear el paciente.", "error");
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                });
        });
    }

    // Edit patient form submit
    const editPatientForm = document.getElementById("editPatientForm");
    if (editPatientForm) {
        editPatientForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const submitBtn = document.getElementById("editSubmitBtn");
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = "Actualizando...";

            hideFormErrors("edit");

            const patientId = document.getElementById("edit_patient_id").value;
            const formData = new FormData(this);

            fetch(`/patients/${patientId}`, {
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
                            Swal.fire(
                                "Error!",
                                data.message ||
                                    "Error al actualizar el paciente.",
                                "error"
                            );
                        }
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    showMessage("Error al actualizar el paciente.", "error");
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                });
        });
    }

    // Search input
    const patientsSearchInput = document.getElementById("patientsSearchInput");
    if (patientsSearchInput) {
        patientsSearchInput.addEventListener("input", function (e) {
            searchPatients(e.target.value);
        });
    }
});
