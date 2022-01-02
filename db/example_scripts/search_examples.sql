SELECT * FROM text_content
WHERE tsvectors @@ plainto_tsquery('english', 'best')
ORDER BY ts_rank(tsvectors, plainto_tsquery('english', 'best')) DESC;

SELECT result_tsvectors FROM (
	SELECT id_content,
		CASE WHEN video.tsvectors IS NULL THEN media_content.tsvectors
			WHEN media_content.tsvectors IS NULL THEN video.tsvectors
			ELSE (media_content.tsvectors || video.tsvectors)
		END
		AS result_tsvectors
	FROM media_content
	LEFT JOIN video
	ON (media_content.id_content = video.id_media_content)
) AS result
WHERE result_tsvectors @@ plainto_tsquery('english', 'game')
ORDER BY ts_rank(result_tsvectors, plainto_tsquery('english', 'game')) DESC;
