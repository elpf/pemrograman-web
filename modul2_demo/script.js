let taskList = document.getElementById('task-list');

function addTask() {
    let taskInput = document.getElementById('new-task');
    let taskText = taskInput.value;

    if (taskText.trim() !== "") {
        let li = document.createElement('li');
        

        let taskContent = document.createElement('input');
        taskContent.type = "text";
        taskContent.value = taskText;
        taskContent.disabled = true;


        let editButton = document.createElement('button');
        editButton.textContent = 'Edit';
        editButton.className = 'edit';
        editButton.onclick = function () {
            if (taskContent.disabled) {
                taskContent.disabled = false;
                editButton.textContent = 'Save';
            } else {
                taskContent.disabled = true;
                editButton.textContent = 'Edit';
            }
        };

        
        let deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.onclick = function () {
            taskList.removeChild(li);
        };

        li.appendChild(taskContent);
        li.appendChild(editButton);
        li.appendChild(deleteButton);
        taskList.appendChild(li);

        taskInput.value = "";
    }
}
