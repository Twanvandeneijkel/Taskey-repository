CREATE TABLE tasks
(
    id           INTEGER PRIMARY KEY,
    title        TEXT,
    description  TEXT,
    priority     INTEGER,
    status       INTEGER,
    progress     INTEGER,
    created_at   INTEGER,
    completed_at INTEGER
);

INSERT INTO tasks (id, title, description, priority, status, progress, created_at, completed_at)
VALUES
    (1,
     'Design Homepage Layout',
     'Create the wireframe and initial layout for the homepage.',
     4,
     1,
     65,
     1709251200,
     0),

    (2,
     'Fix Login Bug',
     'Resolve authentication issue preventing users from logging in.',
     2,
     2,
     100,
     1709164800,
     1709337600),

    (3,
     'Implement Task Filtering',
     'Add functionality to filter tasks by status and priority.',
     3,
     1,
     40,
     1709424000,
     0),

    (4,
     'Write Unit Tests',
     'Create unit tests for TaskRepository and TaskController.',
     1,
     0,
     0,
     1709510400,
     0);