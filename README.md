1. Файл Controller/controller.php содержит маршруты;
2. Http/Request.php обрабатывает информацию полученную из адресной строки;
3. Entities/Note.php класс Note;
4. Repository/NoteRepository.php по id получает из базы данных строку и присваивает значения свойствам класса;
5. В папке Config два файла один с подключением к базе данных, второй подключает используемые классы;
6. В папке Command файлы непосредственно отрабатывающие работу:
   - CreateNote.php  - вносит в базу данных запись;
   - ReadNote.php - получает информацию о записях из базы данных;
   - ReadOneNote - получает информацию об одной записи из базы данных по id;
   - UpdateNote - обновляет информацию в строке базе данных по id;
   - DeleteNote.php - удаляет из базы данных запись;
   - SearchNote.php - выполняет поиск в базе данных и выводит информацию;
   - ReadPaging.php - обрабатывает информацию базы данных, определяет количество строк в базе
   определяет количество страниц по количеству строк и сколько надо отразить записей на странице,
   выдает количество записей в соответствии с номером страницы.
7. DBnotebook.sql - код для создания базы данных.