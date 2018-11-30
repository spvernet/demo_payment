# Amazon Web Service

- Considering that we need to run our application on AWS, we could choose the EC2 servers. 
- We could use "Elastic Load Balancing" as a load balancer to manage the different EC2 instances. 
- In fact, we also can use Amazon EKS to run kubernetes and manage the different containers of our applications.
- The containers would have some ports opened (for example 9000 for php) and it could see the other ports even if they are in different servers because amazon has a dns table that resolve this issue. 
- Finally, just to say amazon launched recently a new service called MSK that could be interesting to investigate.
