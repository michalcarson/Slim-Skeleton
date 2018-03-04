<?php
// Routes

$app->get('/hello', function ($request, $response, $args) {
    return 'welcome';
});

$app->get('/db', function ($request, $response, $args) {
    $html = '';
    /** @var PDOStatement $stmt */
    $stmt = $this->database->query('show databases');
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $html .= '<br>';
        foreach ($row as $key => $val) {
            $html .= $key . ' -- ' . $val . '<br>';
        }
    }
    return $html;
});

$app->get('/dbs', function ($request, $response, $args) {
    /** @var PDOStatement $stmt */
    $stmt = $this->database->query('show databases');
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $this->renderer->render($response, 'db.phtml', ['dbs' => $rows]);
});

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
