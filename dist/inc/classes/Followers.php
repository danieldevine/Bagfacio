<?php
/**
 * Returns a shuffled array of your Twitter Followers
 * God love them.
 */
class Followers
{
    public function __construct($connection)
    {
        $this->connection = $connection;
    }
    public function getFollowers()
    {
        $followers = array();
        $ids = $this->connection->get('followers/ids');
        $ids_arrays = array_chunk($ids->ids, 100);

        foreach ($ids_arrays as $implode) {
            $results = $this->connection->get('users/lookup', array('user_id' => implode(',', $implode)));
            foreach ($results as $profile) {
                $followers[] =  $profile->screen_name;
            }
        }

        $shuffled = shuffle($followers);
        return $shuffled;
    }
}
