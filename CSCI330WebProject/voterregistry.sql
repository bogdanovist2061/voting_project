
/*
	Beckman
	voterregistry.sql
*/

drop database if exists voterregistry;

create database voterregistry;

create table VoterRegistry (
	VoterID int,
	FirstName varchar(30) not null,
	LastName varchar(30) not null,
	Address varchar(30) not null,
	PoliticalAffiliation varchar(50) not null,
	Ward varchar(15)
);

create table CandidateResults (
	PositionSeeking varchar(30) not null,
	CandidateFirstName varchar(30) not null,
	CandidateLastName varchar(30) not null,
	CandidateParty varchar(30) not null,
	Ward varchar(15),
	Votes int
);

create table ProposalResults (
	ProposalName varchar(60) not null,
	ProposalVotes int
);

insert into CandidateResults (PositionSeeking, CandidateFirstName, CandidateLastName,
	CandidateParty, Ward, Votes) values ('Mayor', 'Karl', 'Marx', 'Communist', 'First', 1);
insert into CandidateResults (PositionSeeking, CandidateFirstName, CandidateLastName,
	CandidateParty, Ward, Votes) values ('Mayor', 'Emma', 'Goldman', 'Anarchist', 'Third', 1);
insert into CandidateResults (PositionSeeking, CandidateFirstName, CandidateLastName,
	CandidateParty, Ward, Votes) values ('Sixth Ward', 'Ella', 'Baker', '(d)emocrat', 'Sixth', 1);
insert into CandidateResults (PositionSeeking, CandidateFirstName, CandidateLastName,
	CandidateParty, Ward, Votes) values ('Sixth Ward', 'Fred', 'Hampton', 'Black Panther Party for Self-Defense', 'Sixth', 1);
	
insert into ProposalResults (ProposalName, ProposalVotes) values ('Recreational Marijuana Usage: Yes', 1);
insert into ProposalResults (ProposalName, ProposalVotes) values ('Recreational Marijuana Usage: No', 1);
insert into ProposalResults (ProposalName, ProposalVotes) values ('City-wide Progressive Tax: Yes', 1);
insert into ProposalResults (ProposalName, ProposalVotes) values ('City-wide Progressive Tax: No', 1);
insert into ProposalResults (ProposalName, ProposalVotes) values ('Free College Tuition: Yes', 1);
insert into ProposalResults (ProposalName, ProposalVotes) values ('Free College Tuition: No', 1);	
	
	
	
	
	
	
	