select rank_id, Count(*) as 'total crewmembers of this rank'
from crew
group by rank_id;