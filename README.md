# personnel-department-winestyle

###### ПРИЛОЖЕНИЕ ДЛЯ УПРАВЛЕНИЯ ПЕРСОНАЛОМ

###### MySQL – хранение данных о зарплате сотрудников.

Таблицы:

professions

**Добавить профессии: бухгалтер, курьер, менеджер.**

workers

**Структура: ключевое поле, имя, фамилия, должность, зарплата, ссылка на фото.**

payment

**Таблица будет хранить зарплату сотрудников с учетом премии. Зарплату храним отдельно за каждый месяц.**


Добавить 15 сотрудников. Использовать справочник профессий. Колонку с зарплатой рассчитать в случайном порядке.


###### PHP + HTML + CSS + JS – вывод зарплат сотрудников

Сверстать страницу:

	Вывести данные из таблицы workers, включая миниатюры фото. Зарплату выводим за текущий, либо указанный месяц.

	Для выбора месяца вывести на странице любой календарь.

	При клике на фото сотрудника, открыть его для увеличенного просмотра(использовать любой JQuery плагин)


Реализовать дополнительный функционал:

	Возможность добавлять сотрудников.

	Загрузка фото сотрудников на сервер. При загрузке фото, автоматически создавать миниатюру.

	Загрузка текущего курса доллара и переключение отображения зарплаты: рубли/доллары.

	Возможность выдать премию за указанный месяц всем сотрудникам выбранной профессии.
