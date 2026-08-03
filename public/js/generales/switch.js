const toggleSection = (checkbox, showId, hideId) => {
    document.getElementById(showId).classList.toggle('d-none', !checkbox.checked);
    document.getElementById(hideId).classList.toggle('d-none', checkbox.checked);
};

const teacherSwitch = document.getElementById('useExistingTeacher');
const deviceSwitch = document.getElementById('useExistingDevice');

// Estado inicial (OFF)
toggleSection(teacherSwitch, 'existingTeacher', 'newTeacher');
toggleSection(deviceSwitch, 'existingDevice', 'newDevice');

teacherSwitch.addEventListener('change', function () {
    toggleSection(this, 'existingTeacher', 'newTeacher');
});

deviceSwitch.addEventListener('change', function () {
    toggleSection(this, 'existingDevice', 'newDevice');
});