---
title: "Rinha de Backend 2026 - Part 2"
date: 2026-05-11T10:20:00+00:00
tags: ["Rinha de Backend 2026", "Vector Search", "Embeddings"]
comments: true
disableShare: false
disableHLJS: false
searchHidden: true
ShowPostNavLinks: true
ShowRssButtonInSectionTermList: true
---

The main principle to solve this edition is Vector Search, so before entering this topic, I decided to understand what embeddings are, which is fundamental to understand and implement a Vector Search.

Embeddings are a way of representing objects like images, audio and texts as points in a vector space. The locations of those points are helpful to find similar objects.

## Example

For better understanding, we will use examples of fruits represented as vectors. Each dimension of the vector represents an attribute of the fruit; we will use: sweetness and color. Each dimension value must be between 0 and 1, the green color is equal to 0, and the red color is equal to 1.

| Fruit (Object) | Sweetness | Color |
|----------------|-----------|-------|
| Apple          | 0.7       | 0.9   |
| Banana         | 0.8       | 0.1   |
| Watermelon     | 0.9       | 0.2   |

![Cartesian Plane with Position of Fruits](/images/rinha-de-backend-2026-part-2/desmos-graph.png)

Fonte: <https://www.ibm.com/think/topics/embedding>
