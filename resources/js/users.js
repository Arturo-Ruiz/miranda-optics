// Users Management JavaScript

// Debounce function for search
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
function showMessage(message, type = 'success') {
    const messageContainer = document.getElementById('messageContainer');
    const messageContent = document.getElementById('messageContent');

    messageContainer.classList.remove('hidden');
    messageContent.className = `rounded-md p-4 ${type === 'success' ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700'}`;
    messageContent.textContent = message;

    // Auto-hide after 5 seconds
    setTimeout(() => {
        messageContainer.classList.add('hidden');
    }, 5000);
}

// Show form errors
function showFormErrors(errors, formType) {
    const errorContainer = formType === 'create' ? document.getElementById('createFormErrors') : document.getElementById('editFormErrors');
    const errorList = formType === 'create' ? document.getElementById('createErrorList') : document.getElementById('editErrorList');

    errorList.innerHTML = '';

    Object.values(errors).forEach(errorArray => {
        errorArray.forEach(error => {
            const li = document.createElement('li');
            li.textContent = error;
            errorList.appendChild(li);
        });
    });

    errorContainer.classList.remove('hidden');
}

// Hide form errors
function hideFormErrors(formType) {
    const errorContainer = formType === 'create' ? document.getElementById('createFormErrors') : document.getElementById('editFormErrors');
    errorContainer.classList.add('hidden');
}

// Toggle password visibility
window.togglePassword = function (inputId) {
    const input = document.getElementById(inputId);
    if (input.type === 'password') {
        input.type = 'text';
    } else {
        input.type = 'password';
    }
}

// Open create modal with animation
window.openCreateUserModal = function () {
    const modal = document.getElementById('createUserModal');
    const backdrop = document.getElementById('createModalBackdrop');
    const panel = document.getElementById('createModalPanel');
    const form = document.getElementById('createUserForm');

    form.reset();
    hideFormErrors('create');

    // Show modal
    modal.classList.remove('hidden');

    // Trigger animation
    setTimeout(() => {
        backdrop.classList.remove('opacity-0');
        backdrop.classList.add('opacity-100');
        panel.classList.remove('opacity-0', 'scale-95');
        panel.classList.add('opacity-100', 'scale-100');
    }, 10);
}

// Close create modal with animation
window.closeCreateUserModal = function () {
    const modal = document.getElementById('createUserModal');
    const backdrop = document.getElementById('createModalBackdrop');
    const panel = document.getElementById('createModalPanel');

    // Trigger closing animation
    backdrop.classList.remove('opacity-100');
    backdrop.classList.add('opacity-0');
    panel.classList.remove('opacity-100', 'scale-100');
    panel.classList.add('opacity-0', 'scale-95');

    // Hide modal after animation
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

// Open edit modal with animation
window.editUser = function (id, name, email) {
    const modal = document.getElementById('editUserModal');
    const backdrop = document.getElementById('editModalBackdrop');
    const panel = document.getElementById('editModalPanel');

    document.getElementById('edit_user_id').value = id;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_password').value = '';
    document.getElementById('edit_password_confirmation').value = '';

    hideFormErrors('edit');

    // Show modal
    modal.classList.remove('hidden');

    // Trigger animation
    setTimeout(() => {
        backdrop.classList.remove('opacity-0');
        backdrop.classList.add('opacity-100');
        panel.classList.remove('opacity-0', 'scale-95');
        panel.classList.add('opacity-100', 'scale-100');
    }, 10);
}

// Close edit modal with animation
window.closeEditUserModal = function () {
    const modal = document.getElementById('editUserModal');
    const backdrop = document.getElementById('editModalBackdrop');
    const panel = document.getElementById('editModalPanel');

    // Trigger closing animation
    backdrop.classList.remove('opacity-100');
    backdrop.classList.add('opacity-0');
    panel.classList.remove('opacity-100', 'scale-100');
    panel.classList.add('opacity-0', 'scale-95');

    // Hide modal after animation
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

// Delete user
window.deleteUser = function (id) {
    if (!confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
        return;
    }

    fetch(`/users/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': window.csrfToken,
            'Accept': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showMessage(data.message, 'success');
                // Remove row from table
                const row = document.querySelector(`tr[data-user-id="${id}"]`);
                if (row) {
                    row.remove();
                }

                // Check if table is empty
                const tbody = document.getElementById('usersTableBody');
                if (tbody.children.length === 0) {
                    tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                            No se encontraron usuarios.
                        </td>
                    </tr>
                `;
                }
            } else {
                showMessage(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('Error al eliminar el usuario.', 'error');
        });
}

// Generate HTML for a user row
function getUserRowHtml(user) {
    const date = new Date(user.created_at);
    const formattedDate = date.toLocaleDateString('es-ES', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });

    return `
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${user.id}</td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900">${escapeHtml(user.name)}</div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-500">${escapeHtml(user.email)}</div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formattedDate}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <div class="flex gap-2">
                <button onclick="editUser(${user.id}, '${escapeAttribute(user.name)}', '${escapeAttribute(user.email)}')" 
                    class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-md transition-colors duration-150">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Editar
                </button>
                <button onclick="deleteUser(${user.id})" 
                    class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-md transition-colors duration-150">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Eliminar
                </button>
            </div>
        </td>
    `;
}

// Add user row to table (prepend)
function addUserRow(user) {
    const tbody = document.getElementById('usersTableBody');

    // Remove "no users" message if it exists
    const emptyRow = tbody.querySelector('tr td[colspan="5"]');
    if (emptyRow) {
        emptyRow.parentElement.remove();
    }

    const row = document.createElement('tr');
    row.setAttribute('data-user-id', user.id);
    row.innerHTML = getUserRowHtml(user);

    // Add to the beginning of the table
    tbody.insertBefore(row, tbody.firstChild);
}

// Update entire table
function updateUsersTable(users) {
    const tbody = document.getElementById('usersTableBody');
    tbody.innerHTML = '';

    if (users.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                    No se encontraron usuarios.
                </td>
            </tr>
        `;
    } else {
        users.forEach(user => {
            const row = document.createElement('tr');
            row.setAttribute('data-user-id', user.id);
            row.innerHTML = getUserRowHtml(user);
            tbody.appendChild(row);
        });
    }
}

// Update user row in table
function updateUserRow(user) {
    const row = document.querySelector(`tr[data-user-id="${user.id}"]`);
    if (row) {
        row.innerHTML = getUserRowHtml(user);
    }
}

// Escape HTML
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Escape attribute
function escapeAttribute(text) {
    return text.replace(/'/g, "\\'").replace(/"/g, '&quot;');
}

// Search users
const searchUsers = debounce(function (searchTerm) {
    const url = new URL('/users', window.location.origin);
    url.searchParams.append('search', searchTerm);

    fetch(url, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateUsersTable(data.users.data);

                if (data.pagination) {
                    document.getElementById('paginationContainer').innerHTML = data.pagination;
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}, 300);

// Handle pagination clicks
document.addEventListener('click', function (e) {
    const link = e.target.closest('#paginationContainer a');
    if (link) {
        e.preventDefault();

        fetch(link.href, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateUsersTable(data.users.data);

                    if (data.pagination) {
                        document.getElementById('paginationContainer').innerHTML = data.pagination;
                    }
                    // Update browser URL
                    window.history.pushState({}, '', link.href);
                }
            })
            .catch(error => console.error('Error:', error));
    }
});

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function () {
    // Create user button
    const createUserBtn = document.getElementById('createUserBtn');
    if (createUserBtn) {
        createUserBtn.addEventListener('click', openCreateUserModal);
    }

    // Create user form submit
    const createUserForm = document.getElementById('createUserForm');
    if (createUserForm) {
        createUserForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const submitBtn = document.getElementById('createSubmitBtn');
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = 'Creando...';

            hideFormErrors('create');

            const formData = new FormData(this);

            fetch('/users', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showMessage(data.message, 'success');
                        addUserRow(data.user);
                        closeCreateUserModal();
                        createUserForm.reset();
                    } else {
                        if (data.errors) {
                            showFormErrors(data.errors, 'create');
                        } else {
                            showMessage(data.message || 'Error al crear el usuario.', 'error');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('Error al crear el usuario.', 'error');
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                });
        });
    }

    // Edit user form submit
    const editUserForm = document.getElementById('editUserForm');
    if (editUserForm) {
        editUserForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const submitBtn = document.getElementById('editSubmitBtn');
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = 'Actualizando...';

            hideFormErrors('edit');

            const userId = document.getElementById('edit_user_id').value;
            const formData = new FormData(this);

            fetch(`/users/${userId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.csrfToken,
                    'Accept': 'application/json',
                    'X-HTTP-Method-Override': 'PUT'
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showMessage(data.message, 'success');
                        updateUserRow(data.user);
                        closeEditUserModal();
                    } else {
                        if (data.errors) {
                            showFormErrors(data.errors, 'edit');
                        } else {
                            showMessage(data.message || 'Error al actualizar el usuario.', 'error');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('Error al actualizar el usuario.', 'error');
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                });
        });
    }

    // Search input
    const searchInput = document.getElementById('usersSearchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function (e) {
            searchUsers(e.target.value);
        });
    }
});
