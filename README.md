# 遗传编程

## 百度百科的解释

遗传编程是一种特殊的利用进化算法的机器学习技术， 它开始于一群由随机生成的千百万个计算机程序组成的"人群"，然后根据一个程序完成给定的任务的能力来确定某个程序的适合度，应用达尔文的自然选择（适者生存）确定胜出的程序，计算机程序间也模拟两性组合，变异，基因复制，基因删除等代代进化，直到达到预先确定的某个中止条件为止。遗传编程的基本思想也是借鉴了自然界生物进化理论和遗传的原理，是一种自动随机产生搜索程序的方法。由于该算法作为一种新的全局优化搜索算法，以其简单通用、鲁棒性强，并且对非线性复杂问题显示出很强的求解能力，因而被成功地应用于许多不同的领域，并且在近几年中得到了更深入的研究。

## 维基百科的解释

In artificial intelligence, genetic programming (GP) is a technique of evolving programs, starting from a population of unfit (usually random) programs, fit for a particular task by applying operations analogous to natural genetic processes to the population of programs. It is essentially a heuristic search technique often described as 'hill climbing', i.e. searching for an optimal or at least suitable program among the space of all programs.

## 运行 demo 的方法

```shell
php GeneticProgramming/run.php
```

### 说明:

demo 只包含加法和乘法两种运算，进化目标是生成结果为 100 的数学表达式。

示例：

```
# php GeneticProgramming/run.php
0 0.0030769231
	1+2+3+3+1+(2+2)*3*(1*1+1+3+3+1)=118
1 0.0588235294
	2*2*(3+3+(2+1)*2)*2+2+2+3+1=104
2 0.0588235294
	2*3+3*3*(3+3+3+1)=96
3 0.5000000000
	2*2*(3+3+(2+3)*1)*2+2+2+3+3+1=99
4 0.5000000000
	2*2*(3+3+(2+3)*1)*2+2+2+1+2+3+1=99
5 0.5000000000
	2*2*(3+3+(2+3)*1)*2+2+2+1+2+3+1=99
6 0.5000000000
	2*2*(3+3+(2+3)*1)*2+2+2+1+2+3+1=99
7 0.5000000000
	2*2*(3+3+(2+3)*1)*2+3*3+3+1=101
8 0.5000000000
	2*2*(3+3+(2+3)*1)+2+2+2+3+2*2*(3+2*2+(2+3)*1)=101
9 1.0000000000
	2*2*(3+3+3+2)*2+2+2+3+3+2=100
Finish.
```