<?php
/**
 * Created by PhpStorm.
 * User: mgheorghita
 * Date: 4/26/2016
 * Time: 2:56 PM
 */

class Tweet extends Model{
    protected $id;
    protected $tweet;
    protected $image;
    protected $date;
    protected $tweetTitle;
    protected $userId;
    protected $first_name;
    protected $last_name;

    public function __construct()
    {
        parent::__construct();
    }


    public function setId($id)
    {
        $this->id = $id;
    }
    public function setTweet($tweet)
    {
        $this->tweet = $tweet;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setTweetTitle($tweetTitle)
    {
        $this->tweetTitle = $tweetTitle;
    }
    
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getId()
    {
        return  Filter::value($this->id);
    }

    public function getTweet()
    {
        return  Filter::value($this->tweet);
    }
    public function getTweetTitle()
    {
        return  Filter::value($this->tweetTitle);
    }
    public function getImage()
    {
        return  Filter::value($this->image);
    }

    public function getDate()
    {
        return  Filter::value($this->date);
    }

    public function getUserId()
    {
        return $this->userId;
    }


    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return  Filter::value($this->last_name);
    }

    public function getTweets($idStart = 0)
    {
        $sql= "SELECT * FROM
               ((SELECT tweet.id, tweet.tweet, tweet.userId, tweet.image, tweet.date, follower.userId as follUserId, follower.followerUserId, user.first_name, user.last_name, user.avatar FROM tweet 
                INNER JOIN follower on follower.followerUserId = tweet.userId 
                INNER JOIN user on user.id = follower.followerUserId
                WHERE follower.userId = " .Session::get('userId');
        if($idStart !== 0) {
            $sql .= " and tweet.id < " . $idStart;
        }
        $sql .=")
                UNION
                (SELECT tweet.id, tweet.tweet, tweet.userId, tweet.image,tweet.date, '','', user.first_name, user.last_name, user.avatar FROM tweet 
                INNER JOIN user on userId = user.id WHERE userId = " .Session::get('userId');
        if($idStart !== 0) {
            $sql .= " and tweet.id < " . $idStart;
        }
        $sql .=") )a order by date desc, id desc limit 10";

      return  $this->query($sql,__CLASS__);
    }

    public function getOwnTweets($userId = '')
    {
        if(empty($userId))
        {
            $userId = Session::get('userId');
        }

        $this->setJoin('INNER JOIN user on userId = user.id');
        $this->setWhere('WHERE userId = '.$userId);
        $this->setLimit(50);
        $this->setOrder('date','desc');

        return  $this->select('tweet',__CLASS__, array('tweet.id','userId', 'tweet.tweet', 'tweet.image', 'tweet.date','first_name','last_name'));
    }
    public function getFavoriteTweets()
    {
        $userId = Session::get('userId');
        $sql = "SELECT tweet.id, tweet.tweet, image, date, tweet.userId, user.first_name, user.last_name FROM tweet 
                INNER JOIN favorites on tweet.id = favorites.tweetId 
                INNER JOIN user on user.id = favorites.userId 
                WHERE favorites.userId = ".$userId."  order by date desc";
        return $this->query($sql,__CLASS__);
    }
    public function getFollowingNewTweets()
    {
        $userId = Session::get('userId');
        $this->setJoin('INNER JOIN follower on follower.followerUserId = tweet.userId INNER JOIN user on user.id = follower.followerUserId');
        $this->setWhere("WHERE follower.userId = ".$userId." and tweet.date >='".Session::get('dateCheck')."'");
        $this->setOrder('date', 'desc');
        return $this->select('tweet', __CLASS__, array('tweet.id', 'tweet.tweet', 'image', 'date', 'tweet.userId', 'follower.userId', 'follower.followerUserId', 'user.first_name', 'user.last_name'));
    }

    public function getFollowingTweets($tweetId )
    {
        $userId = Session::get('userId');
        $sql = "SELECT tweet.id, tweet.tweet, image, date, tweet.userId, follower.userId, follower.followerUserId, user.first_name, user.last_name  FROM tweet INNER JOIN follower on follower.followerUserId = tweet.userId 
                                    INNER JOIN user on user.id = follower.followerUserId 
                                    WHERE follower.userId = ".$userId." and tweet.id >".$tweetId." order by date desc limit 25";
       return $this->query($sql,__CLASS__);
    }

    public function getIfFollow($userId)
    {
        $this->setJoin("");
        $this->setWhere("WHERE follower.followerUserId = ".$userId." and follower.userId ='".Session::get('userId')."'");
        $this->setOrder('id','asc');
        return $this->select('follower',__CLASS__);
    }
    public function getIfFavorite($tweetId)
    {
        $this->setJoin("");
        $this->setWhere("WHERE favorites.tweetId= ".$tweetId." and favorites.userId ='".Session::get('userId')."'");
        $this->setOrder('id','asc');
        return $this->select('favorites',__CLASS__);
    }
    
    public function addTweet($content, $data, $userId, $image,$firstName,$lastName)
    {
        $sth = $this->db->prepare('INSERT INTO tweet(tweet, image, date, userId) VALUES(:content,:image,:data,:userId)');
        $sth->bindValue(':content', $content, PDO::PARAM_STR);
        $sth->bindValue(':image', $image, PDO::PARAM_STR);
        $sth->bindValue(':data', $data, PDO::PARAM_STR);
        $sth->bindValue(':userId', $userId, PDO::PARAM_INT);
        
        try {
            $sth->execute();
            Logging::register()->info("Successful insert of a new tweet in database");
            
            $this->setTweet($content);
            $this->setImage($image);
            $this->setDate($data);
            $this->setUserId($userId);
            $this->first_name = $firstName;
            $this->last_name =  $lastName;
            $this->setId($this->db->lastInsertId());
            
            return True;
            
        } catch (PDOException $e) {            
            Logging::register()->error($e->getMessage());
            return False;
        }
    }
    public function insertFavoriteTweet($userId, $tweetId)
    {
        return $this->insert('favorites', array('userId' => $userId, 'tweetId' => $tweetId));
    }
}