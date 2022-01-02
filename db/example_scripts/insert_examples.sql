WITH new_id_content AS (
    INSERT INTO content (id_group, id_creator) VALUES (NULL, 1) RETURNING id
)
INSERT INTO text_content (id_content, post_text) VALUES ((SELECT id FROM new_id_content), 'This is a text post. :)');
