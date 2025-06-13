-- Alepo Database Cleanup Queries
-- Run these in phpMyAdmin or database tool

-- 1. First, see what we're deleting (PREVIEW)
SELECT p.ID, p.post_title, p.post_date 
FROM wp_posts p 
INNER JOIN wp_postmeta pm ON p.ID = pm.post_id 
WHERE pm.meta_key = '_alepo_custom_generated' 
AND pm.meta_value = '1' 
AND p.post_type = 'page';

-- 2. Delete generated page content
DELETE p FROM wp_posts p 
INNER JOIN wp_postmeta pm ON p.ID = pm.post_id 
WHERE pm.meta_key = '_alepo_custom_generated' 
AND pm.meta_value = '1' 
AND p.post_type = 'page';

-- 3. Clean up associated metadata
DELETE FROM wp_postmeta 
WHERE post_id NOT IN (SELECT ID FROM wp_posts);

-- 4. Clean up any orphaned term relationships
DELETE FROM wp_term_relationships 
WHERE object_id NOT IN (SELECT ID FROM wp_posts);

-- 5. Reset auto-increment (optional, for clean IDs)
ALTER TABLE wp_posts AUTO_INCREMENT = 1;

-- 6. Verify cleanup
SELECT COUNT(*) as total_pages FROM wp_posts WHERE post_type = 'page' AND post_status = 'publish';