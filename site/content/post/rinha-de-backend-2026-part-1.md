---
title: "Rinha de Backend 2026 - Part 1"
date: 2026-05-11T00:02:00+00:00
tags: ["Rinha de Backend 2026", "Vector Search"]
comments: true
disableShare: false
disableHLJS: false
searchHidden: true
ShowPostNavLinks: true
ShowRssButtonInSectionTermList: true
---

Rinha de Backend in a code challenge where you compete with other developers to build a backend under CPU, memory, and architecture constraints. The theme of the year is fraud detection using vector search.

> For more information, please visit the [Rinha de Backend Repository](https://github.com/zanfranceschi/rinha-de-backend-2026).

This project already had previous editions. In this one, I will document the process of building my solution to this Code Challenge. This edition has a base principle that I’m unfamiliar with: **Vector Search**. The next posts will be reporting my progress and what I’m learning in the process.

## The challenge

Build a fraud detection API for card transactions using vector search. For each incoming transaction, you transform the payload into a vector, search the reference dataset for the most similar transactions and decide whether to approve or deny it.

## Infrastructure constraints

- Your solution must have at least one load balancer and two instances of your API, distributing load in round-robin.
- The load balancer must not apply detection logic — it only distributes requests.
- Your submission must be a docker-compose.yml with public images compatible with linux-amd64.
- The sum of the limits of all your services must not exceed 1 CPU and 350 MB of memory.
- Network mode must be bridge. host and privileged modes are not allowed.
- Your application must respond on port 9999.

## Scoring

Your final score is the sum of two independent components: latency and detection quality. Each ranges from -3000 to +3000, so the total ranges from -6000 to +6000.

- Latency (score_p99) — computed from the observed p99. Each 10x improvement is worth +1000 points. Saturates at +3000 when your p99 is 1 ms or lower. Fixed at -3000 if your p99 exceeds 2000 ms.
- Detection (score_det) — combines a weighted error rate (false positives, false negatives and HTTP errors) with an absolute penalty. HTTP errors weigh more than false negatives, which weigh more than false positives. If your failure rate exceeds 15%, the score is fixed at -3000.
