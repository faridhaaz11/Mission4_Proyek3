// Data mahasiswa dalam format array of objects
const students = typeof studentsData !== 'undefined' ? studentsData : [];

// Data mata kuliah dalam format array of objects
const courses = typeof coursesData !== 'undefined' ? coursesData : [];

// Data mata kuliah yang sudah di-enroll (diambil)
const enrolledCourses = typeof enrolledCoursesData !== 'undefined' ? enrolledCoursesData : [];

// Fungsi untuk menambahkan mahasiswa baru ke tabel secara dinamis (tanpa refresh)
function addNewStudentToTable(nim, namaLengkap, jenisKelamin, tanggalLahir, umur) {
    const studentTableBody = document.getElementById('student-table-body');
    if (!studentTableBody) {
        console.error("Elemen dengan ID 'student-table-body' tidak ditemukan.");
        return;
    }
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>${nim}</td>
        <td>${namaLengkap}</td>
        <td>${jenisKelamin === 'L' ? 'Laki-laki' : 'Perempuan'}</td>
        <td>${tanggalLahir}</td>
        <td>${umur}</td>
        <td>
          <a href="/mahasiswa/view/${nim}" class="btn btn-info btn-sm">View</a>
          <a href="/mahasiswa/edit/${nim}" class="btn btn-warning btn-sm">Edit</a>
          <a href="/mahasiswa/delete/${nim}" class="btn btn-danger btn-sm btn-delete-mahasiswa" data-nim="${nim}">Hapus</a>
        </td>
    `;
    studentTableBody.appendChild(newRow);
}

// Fungsi untuk menambahkan mata kuliah baru ke tabel secara dinamis (tanpa refresh)
function addNewCourseToTable(id, nama, credits) {
    const courseTableBody = document.getElementById('course-table-body');
    if (!courseTableBody) {
        console.error("Elemen dengan ID 'course-table-body' tidak ditemukan.");
        return;
    }
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>${id}</td>
        <td>${nama}</td>
        <td>${credits}</td>
        <td>
            <a href="/manage-courses/edit/${id}" class="btn btn-warning btn-sm">Edit</a>
            <a href="/manage-courses/delete/${id}" class="btn btn-danger btn-sm btn-delete-course" data-id="${id}">Hapus</a>
        </td>
    `;
    courseTableBody.appendChild(newRow);
}

// Fungsi untuk menambahkan mata kuliah ke tabel enroll_courses
function addNewEnrollCourseToTable(id, nama, credits, isEnrolled) {
    const courseListBody = document.getElementById('course-list-body');
    if (!courseListBody) {
        console.error("Elemen dengan ID 'course-list-body' tidak ditemukan.");
        return;
    }
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td><input type="checkbox" name="course_id[]" value="${id}" ${isEnrolled ? 'disabled' : ''}></td>
        <td>${id}</td>
        <td>${nama}</td>
        <td>${credits} ${isEnrolled ? '<span class="badge bg-success">Sudah Diambil</span>' : ''}</td>
    `;
    courseListBody.appendChild(newRow);
}

// Fungsi untuk menghitung total SKS dari mata kuliah yang dipilih
function calculateTotalSKS(courses) {
    const checkboxes = document.querySelectorAll('input[type="checkbox"][name="course_id[]"]');
    let totalSKS = 0;
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            const courseId = parseInt(checkbox.value);
            const course = courses.find(c => parseInt(c.course_id) === courseId);
            if (course) {
                totalSKS += parseInt(course.credits);
            }
        }
    });
    const totalSKSLabel = document.getElementById('totalSKS');
    if (totalSKSLabel) {
        totalSKSLabel.textContent = totalSKS;
    }
}

// Fungsi untuk menampilkan modal validasi
function showValidationModal(message) {
    const modal = new bootstrap.Modal(document.getElementById('validationModal'));
    document.getElementById('validationMessage').textContent = message;
    modal.show();
}

// Fungsi untuk menampilkan modal konfirmasi hapus
function showDeleteConfirmationModal(type, dataId, name, optionalSks) {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    const messageElement = document.getElementById('deleteMessage');
    const confirmButton = document.getElementById('confirmDeleteButton');

    let message = '';
    let deleteUrl = '';

    if (type === 'course') {
        message = `Yakin ingin menghapus mata kuliah ${name} (SKS: ${optionalSks})?`;
        deleteUrl = `/manage-courses/delete/${dataId}`;
    } else if (type === 'student') {
        message = `Yakin ingin menghapus data mahasiswa bernama ${name} dengan NIM ${dataId}?`;
        deleteUrl = `/mahasiswa/delete/${dataId}`;
    } else if (type === 'enrolled_course') {
        message = `Yakin ingin menghapus mata kuliah ${name} dari daftar mata kuliah Anda?`;
        deleteUrl = `/mahasiswa/delete-enrolled/${dataId}`;
    }

    messageElement.textContent = message;
    confirmButton.href = deleteUrl;

    modal.show();
}

// Kode utama yang dijalankan setelah semua elemen HTML selesai dimuat
document.addEventListener('DOMContentLoaded', () => {
    // Mengisi tabel mahasiswa
    const studentTableBody = document.getElementById('student-table-body');
    if (studentTableBody && typeof studentsData !== 'undefined') {
        studentsData.forEach(student => {
            addNewStudentToTable(student.nim, student.nama_lengkap, student.jenis_kelamin, student.tanggal_lahir, student.umur);
        });
    }

    // Mengisi tabel mata kuliah (Admin)
    const courseTableBody = document.getElementById('course-table-body');
    if (courseTableBody && typeof coursesData !== 'undefined') {
        coursesData.forEach(course => {
            addNewCourseToTable(course.course_id, course.course_name, course.credits);
        });
        
        // PENTING: Lampirkan event listener setelah tombol-tombol dibuat
        document.querySelectorAll('.btn-delete-course').forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault();
                const courseId = parseInt(event.target.getAttribute('data-id'));
                const course = coursesData.find(c => parseInt(c.course_id) === courseId);
                if(course) {
                    showDeleteConfirmationModal('course', course.course_id, course.course_name, course.credits);
                }
            });
        });
    }

    // Mengisi tabel pendaftaran mata kuliah (Mahasiswa)
    const courseListBody = document.getElementById('course-list-body');
    if (courseListBody && typeof coursesData !== 'undefined') {
        const enrolledCourseIds = typeof enrolledIds !== 'undefined' ? enrolledIds : [];
        coursesData.forEach(course => {
            const isEnrolled = enrolledCourseIds.includes(parseInt(course.course_id));
            addNewEnrollCourseToTable(course.course_id, course.course_name, course.credits, isEnrolled);
        });

        // Event listener untuk form Ambil Mata Kuliah
        const enrollForm = document.getElementById('enrollForm');
        if (enrollForm) {
            const courseCheckboxes = document.querySelectorAll('input[type="checkbox"][name="course_id[]"]');
            courseCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => calculateTotalSKS(coursesData));
            });
            enrollForm.addEventListener('submit', (event) => {
                const checkboxes = document.querySelectorAll('input[type="checkbox"][name="course_id[]"]');
                let anyChecked = false;
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        anyChecked = true;
                    }
                });
                if (!anyChecked) {
                    event.preventDefault();
                    showValidationModal('Pilih setidaknya satu mata kuliah.');
                }
            });
            calculateTotalSKS(coursesData);
        }
    }
    
    // Menangani konfirmasi hapus untuk mata kuliah yang sudah di-enroll
    const enrolledCourses = typeof enrolledCoursesData !== 'undefined' ? enrolledCoursesData : [];
    document.querySelectorAll('.btn-delete-enrolled').forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            const courseId = parseInt(event.target.getAttribute('data-course-id'));
            const course = enrolledCourses.find(c => parseInt(c.course_id) === courseId);
            if (course) {
                showDeleteConfirmationModal('enrolled_course', course.course_id, course.course_name);
            }
        });
    });

    // Menangani konfirmasi hapus untuk mahasiswa
    document.querySelectorAll('.btn-delete-mahasiswa').forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            const nim = event.target.getAttribute('data-nim');
            const student = students.find(s => s.nim === nim);
            if(student) {
                showDeleteConfirmationModal('student', student.nim, student.nama_lengkap);
            }
        });
    });

    // Validasi form Tambah Mahasiswa
    const createForm = document.getElementById('createMahasiswaForm');
    if (createForm) {
        createForm.addEventListener('submit', (event) => {
            let isValid = true;
            // Ambil semua input dalam form
            const formInputs = createForm.querySelectorAll('input, select');
            
            formInputs.forEach(input => {
                const errorSpan = document.getElementById(input.id + '-error');
                if (input.id === 'jenis_kelamin') {
                    // Abaikan validasi jenis kelamin
                } else if (input.value.trim() === '') {
                    input.style.borderColor = 'red';
                    if (errorSpan) {
                        errorSpan.textContent = 'Field ini wajib diisi.';
                    }
                    isValid = false;
                } else {
                    input.style.borderColor = '';
                    if (errorSpan) {
                        errorSpan.textContent = '';
                    }
                }
            });
            
            if (!isValid) {
                event.preventDefault();
                showValidationModal('Semua field wajib diisi!');
            }
        });
    }

    // Validasi form Tambah Mata Kuliah
    const addCourseForm = document.getElementById('addCourseForm');
    if (addCourseForm) {
        addCourseForm.addEventListener('submit', (event) => {
            const courseNameInput = document.getElementById('course_name');
            const creditsInput = document.getElementById('credits');
            
            let isValid = true;

            function showError(inputElement, messageElementId, message) {
                inputElement.style.borderColor = 'red';
                document.getElementById(messageElementId).textContent = message;
                isValid = false;
            }

            function clearError(inputElement, messageElementId) {
                inputElement.style.borderColor = '';
                document.getElementById(messageElementId).textContent = '';
            }

            if (courseNameInput.value.trim() === '') {
                showError(courseNameInput, 'course_name-error', 'Nama Mata Kuliah wajib diisi.');
            } else {
                clearError(courseNameInput, 'course_name-error');
            }

            if (creditsInput.value.trim() === '') {
                showError(creditsInput, 'credits-error', 'Credits wajib diisi.');
            } else {
                clearError(creditsInput, 'credits-error');
            }
            
            if (!isValid) {
                event.preventDefault();
                showValidationModal('Semua field wajib diisi!');
            }
        });
    }

    // Menangani konfirmasi Logout dengan modal
    const logoutButton = document.getElementById('logoutButton');
    if (logoutButton) {
        logoutButton.addEventListener('click', (event) => {
            event.preventDefault(); // Mencegah aksi default tombol
            
            // Tampilkan modal konfirmasi logout
            const logoutModal = new bootstrap.Modal(document.getElementById('logoutModal'));
            logoutModal.show();
        });
    }
});