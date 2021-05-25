$(document).ready(function() {
  // Global Settings
  let edit = false;

  // Testing Jquery
  console.log('jquery is working!');
  fetchTasks();
  $('#task-result').hide();


  // search key type event
  $('#search').keyup(function() {
    if($('#search').val()) {
      let search = $('#search').val();
      $.ajax({
        url: '../../database/book-search.php',
        data: {search},
        type: 'POST',
        success: function (response) {
          if(!response.error) {
            let tasks = JSON.parse(response);
            let template = '';
            tasks.forEach(task => {
              template += `<li><a href="#" class="task-item">${task.name}</a></li>`
            });
            $('#task-result').show();
            $('#container').html(template);
          }
        }
      })
    }
  });
  // mi books
  function MiBooks() {
    $.ajax({
      url: '../../database/list.php',
      type: 'GET',
      success: function(response) {
        const tasks = JSON.parse(response);
        let template = '';
        tasks.forEach(books => {
          template += `
                  <tr booksId="${books.id}">
                  <td>${books.id}</td>
                  <td>
                    ${books.title}
                  </td>
                    <td>${books.author}</td>
                  <td>${books.description}</td>
                  <td>
                    <button class="books-delete btn btn-danger">
                     devolver
                    </button>
                  </td>
                  </tr>
                `
        });
        $('#tasks').html(template);
      }
    });
  }




  // Fetching Tasks
  function fetchBooks() {
    $.ajax({
      url: '../../database/list.php',
      type: 'GET',
      success: function(response) {
        const books = JSON.parse(response);
        let template = '';
        tasks.forEach(books => {
          template += `
                  <tr booksId="${books.id}">
                  <td>${books.id}</td>
                  <td>
                    ${books.title}
                  </td>
                    <td>${books.author}</td>
                  <td>${books.description}</td>
                  <td>
                    <button class="books-get btn btn-danger">
                     Optener
                    </button>
                  </td>
                  </tr>
                `
        });
        $('#tasks').html(template);
      }
    });
  }

  // // Get a Single Task by Id
  // $(document).on('click', '.task-item', (e) => {
  //   const element = $(this)[0].activeElement.parentElement.parentElement;
  //   const id = $(element).attr('taskId');
  //   $.post('task-single.php', {id}, (response) => {
  //     const task = JSON.parse(response);
  //     $('#name').val(task.name);
  //     $('#description').val(task.description);
  //     $('#taskId').val(task.id);
  //     edit = true;
  //   });
  //   e.preventDefault();
  // });

  // get book
  $(document).on('click', '.books-get', (e) => {
    if(confirm('Are you sure you want to get it?')) {
      const element = $(this)[0].activeElement.parentElement.parentElement;
      const id = $(element).attr('booksId');
      $.post('../../database/getbook.php', {id}, (response) => {
        fetchTasks();
      });
    }
  });

  //return book
  $(document).on('click', '.books-return', (e) => {
    if(confirm('Are you sure you want to return it?')) {
      const element = $(this)[0].activeElement.parentElement.parentElement;
      const id = $(element).attr('booksId');
      $.post('../../database/returnbook.php', {id}, (response) => {
        fetchTasks();
      });
    }
  });

});
