<?php
/**
 * 
 * 
 */
class Database
{
    private static $_instace=NULL;
    private static $sql=[];
    private $mysqli;
    
    public function __construct()
    {
        /**
         * 
         * Connection
         */
        $this->mysqli = new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);

        /**
         * 
         * checking connection
         */
        if($this->mysqli->connect_errno)
		{
			echo "failed to connect to MYSQLi : (".$this->mysqli->connect_errno.") ".$this->mysqli->connect_error;
		}else{
            return false;
        }
    }

    /**
     * 
     * auto reconnecting database 
     */
    public static function getInstance()
    {
        if( !isset(self::$_instace) )
        {
            self::$_instace = new Database;
        }
    }


    /**
     * 
     * set table
     */
    public static function table($table)
    {
        /**
         * renewed
         */
        self::$sql = NULL;
        
        self::$sql['table'] = $table;
        return new self;
    }
    
    /**
     * 
     * insert data 
     * variable data is an array
     */
    public function insert($data)
    {
        $val=[];
        foreach ($data as $key => $value) {

            if(!is_null($value)):

                if(is_int($value)):
                    $values = $value;
                else:
                    $values = "'".$value."'";
                endif;

            else:
                $values = 'NULL';
            endif;

            // is integer
            // $values = is_int($value) ? $value : "'".$value."'";

            // is null
            // $values = is_null($value) ? 'NULL' : $value ;

            $val[] = $values;
        }

        $val = implode(',', $val);
        $col = implode(',', array_keys($data));

        $sql = "insert into ".self::$sql['table']."($col) values ($val)";
        // var_dump($sql);die();

        if($this->mysqli->query($sql)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 
     * 
     * update data
     */
    public function update($datas)
    {
        $data=[];
        foreach ($datas as $key => $value) {
            $data[] = $key."= '".$value."'";
        }
        $data = implode(',', $data);

        self::$sql = 'update '.self::$sql['table'].' set '.$data.' '. self::$sql['condition'];
        
        if($this->mysqli->query(self::$sql)){
            return true;
        }else{
            return false;
        }


    }

    /**
     * 
     * delete data
     * cond must be id data
     * or something unik data
     */
    public function delete($cond=[])
    {
        if (empty(self::$sql['condition']))
        {
            if(!isset(self::$sql['raw']))
            {
                $val=[];
                foreach ($cond as $key => $value) {
                    $val[] = is_int($value) ? $value : "'".$value."'";
                }
                $val = implode(',', $val);
                $col = implode(',', array_keys($cond));

                self::$sql['condition'] = "where $col = $val";

            }else{
                self::$sql['condition'] = self::$sql['raw'];
            }
        }

        self::$sql =  'delete from '. self::$sql['table'] .' '. self::$sql['condition'];
        // var_dump(self::$sql);die();

        if($this->mysqli->query(self::$sql))
        {
            return true;
        }else
        {
            return false;
        }
    }

    /**
     * 
     * join
     * sintaks default is inner join or simple join
     */
    public function join($table)
    {
        /**
         * 
         * rewrite data table
         */
        if(preg_match('/join/', self::$sql['table']))
        {
            self::$sql['table'] .= self::$sql['condition']." join ".$table." ";
        }else{
            self::$sql['table'] = self::$sql['table']." join ".$table." ";
        }

        return new self;
    }

    public function leftJoin($table)
    {
        /**
         * 
         * rewrite data table
         */
        if(preg_match('/join/', self::$sql['table']))
        {
            self::$sql['table'] .= self::$sql['condition']." left join ".$table." ";
        }else{
            self::$sql['table'] = self::$sql['table']." left join ".$table." ";
        }

        return new self;
    }

    public function raw($conditionRaw)
    {
        self::$sql['raw'] = "where ".$conditionRaw;

        return new self;
    }

    public function on($key=[],$cond,$value=NULL)
    {    
        /**
         * 
         * cons operator to comparing data
         * 
         * then set function count() to know
         * how much array data 
         */
        $condSolid = ['=','==','>','<>','<','like','!=','!==','%'];

        $condCount = count($condSolid);

        /**
         * 
         * looping array data argument
         */
        $i=0;
        while ($i < $condCount) {
            $case = $cond == $condSolid[$i]; // boolean

            // checking case
            $result = $case ? true : false;
            if($result) break;

            $i++;
        }

        if($result)
        {
            // set condition
            self::$sql['condition'] = 'on '. $key.' '.$cond.' '.$value;
        }else
        {
            // set condition
            self::$sql['condition'] = 'on '. $key .' '. $condSolid[0] .' '.$cond;
        }

        return new self;

    }


    /**
     * 
     * set condition
     */
    public function where($key,$cond,$value=NULL)
    {
        /**
         * 
         * cons operator to comparing data
         * 
         * then set function count() to know
         * how much array data 
         */
        $condSolid = ['=','==','>','<>','<','like','!=','!==','%'];

        $condCount = count($condSolid);

        /**
         * 
         * looping array data argument
         */
        $i=0;
        while ($i < $condCount) {
            $case = $cond == $condSolid[$i]; // boolean

            // checking case
            $result = $case ? true : false;
            if($result) break;

            $i++;
        }

        if($result)
        {
            // filter value
            is_string($value) ? $value =  "'". $value ."'" : $value = $value;

            // set condition
            self::$sql['condition'] = 'where '. $key.' '.$cond.' '.$value;
        }else
        {
            // filter value
            is_string($cond) ? $cond =  "'". $cond ."'" : $cond = $cond;

            // set condition
            self::$sql['condition'] = 'where '. $key .' '. $condSolid[0] .' '.$cond;
        }

        return new self;
    }

    public function orderBy($column, $direction)
    {
        self::$sql['direction'] = "order by ".$column.' '.$direction;

        return new self;
    }

    /**
     * 
     * set column
     * 
     * 
     */
    public function fetch( $column = NULL )
    {
        /**
         * 
         * if column is an array
         */
        if(is_array($column)){
            $col=[];
            foreach ($column as $key => $value) {
                $col[] = $value;
            }
        }
        $col = implode(",", $col);
        self::$sql['column'] = "$col";
        return new self;
    }

    public function get()
    {
        /**
         * 
         * check all part
         * 
         * set data or set default
         */
        self::$sql['column'] = empty(self::$sql['column']) ? "*" : self::$sql['column'];
        self::$sql['condition'] = empty(self::$sql['condition']) ? "" : self::$sql['condition'];
        self::$sql['direction'] = empty(self::$sql['direction']) ? "" : self::$sql['direction'];
        self::$sql['raw'] = empty(self::$sql['raw']) ? "" : self::$sql['raw'];

        /**
         * 
         * set default sql
         */
        $query = "select ". self::$sql['column'] ." from ". self::$sql['table'] ." ". self::$sql['condition'] ." ". self::$sql['raw'] ." ". self::$sql['direction'];
        // var_dump($query); return true;

        /**
         * 
         * get query
         */
        $res = $this->mysqli->query($query);

        /**
         * 
         * fetch data
         * 
         * when data more than one rows,
         * use while looping to fetch data
         */
        if(!$res){
            return $result = NULL;
        }
        $num = $res->num_rows;
        if ($num <> 1) {
            while($row = $res->fetch_assoc())
            $result[] = $row;
        }else{
            $result = $res->fetch_assoc();
        }

        /**
         * 
         * passing result data
         * 
         * data set null when no rows to passing
         */
        return !isset($result) ? $result=NULL : $result=$result;
        
    }

}