<?php namespace Laravel\Database\Eloquent\Relationships;

class Has_One extends Has_One_Or_Many {

	/**
	 * Get the properly hydrated results for the relationship.
	 *
	 * @return Model
	 */
	public function results()
	{
		return parent::first();
	}

	/**
	 * Initialize a relationship on an array of parent models.
	 *
	 * @param  array   $parents
	 * @param  string  $relationship
	 * @return void
	 */
	public function initialize(&$parents, $relationship)
	{
		foreach ($parents as &$parent)
		{
			$parent->relationships[$relationship] = null;
		}
	}

	/**
	 * Match eagerly loaded child models to their parent models.
	 *
	 * @param  array  $parents
	 * @param  array  $children
	 * @return void
	 */
	public function match($relationship, &$parents, $children)
	{
		$foreign = $this->foreign_key();

		$children_hash = array();
		foreach ($children as $child)
		{
			if (array_key_exists($child->pivot->$foreign, $children_hash))
			{
				continue;
			}

			$children_hash[$child->pivot->$foreign] = $child;
		}

		foreach ($parents as $parent)
		{
			if (array_key_exists($parent->get_key(), $children_hash))
				$parent->relationships[$relationship] = $children_hash[$parent->get_key()];
		}
	}

}