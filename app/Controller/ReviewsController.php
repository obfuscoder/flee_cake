<?php

App::uses('AppModel', 'Model');

class ReviewsController extends AppController {
	public function admin_index() {
		$this->set("reviews", $this->Review->find("all"));

        /* TODO sold stats per category
            select c.name as Kategorie,count(*) as angeboten,SUM(if(ri.sold is not null, 1, 0)) AS verkauft, concat(round(SUM(if(ri.sold is not null, 1, 0)) / count(*) * 100,0), "%") as Rate
            from categories c
            join items i on i.category_id=c.id
            join reserved_items ri on ri.item_id=i.id
            group by c.name
            order by c.name
        */
	}
}

?>