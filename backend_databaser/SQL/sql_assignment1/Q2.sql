select dep_id, Count(*) as 'total crewmembers of this rank'
from crew
group by dep_id;