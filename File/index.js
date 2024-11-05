class Node {
    constructor(string, state) {
        this.string = string; // sigma: {0,1}
        this.state = state; // Q: {q0,q1}
        this.children = [];
    }
}

function test() {
    const input = document.getElementById('inputString').value.trim();
    const root = new Node('Start', 'q0');
    computationalTree(root, input, 0);
    displayTree(root);
    acceptancecheck(root, input);
    // need ng magchecheck kung may ibang nainput
    // dapat 0 or 1 lang
}

// logic
function computationalTree(node, input, i) {
    if (i >= input.length) return;

    const sigma = input[i]; //array[0]
    const currentState = node.state;

    if (currentState === 'q0') {
        if (sigma === '0') {
            const newNode = new Node(sigma, 'q1'); // new Node(current sigma, '')
            node.children.push(newNode);
            computationalTree(newNode, input, i + 1);
        }
        const newNode = new Node(sigma, 'q0');
        node.children.push(newNode);
        computationalTree(newNode, input, i + 1);
    } else if (currentState === 'q1') {
        if (sigma === '0') {
            const newNode = new Node(sigma, 'p');
            node.children.push(newNode);
            computationalTree(newNode, input, i + 1);
        }
        const newNode = new Node(sigma, 'p');
        node.children.push(newNode);
        computationalTree(newNode, input, i + 1);
    }
}

// magcheck ng acceptance
function acceptancecheck(root, input) {
    let isAccepted = false;

    function traverse(node, path) {
        if (path.length === input.length && node.state === 'q1' && input.endsWith('0')) {
            isAccepted = true;
        }
        for (const child of node.children) {
            traverse(child, path + child.string);
        }
    }
    traverse(root, '');
    document.getElementById('result').innerText = isAccepted ?
        `The "${input}" is accepted.` :
        `The "${input}" is not accepted.`;
}

//galing kay chatgpt
//using d3js library
function displayTree(root) {
    document.getElementById('tree').innerHTML = ''; // Clear previous SVG
    const width = 800; // width ng svg
    const height = 500; // height
    const treeLayout = d3.tree().size([width - 60, height - 60]);
    const hierarchyData = d3.hierarchy(root, node => node.children);
    const treeData = treeLayout(hierarchyData);

    const svg = d3.select("#tree")
                  .append("svg")
                  .attr("width", width)
                  .attr("height", height)
                  .append("g")
                  .attr("transform", "translate(20, 20)");

    // Links
    svg.selectAll(".link")
       .data(treeData.links())
       .enter()
       .append("line")
       .attr("class", "link")
       .attr("x1", d => d.source.x)
       .attr("y1", d => d.source.y)
       .attr("x2", d => d.target.x)
       .attr("y2", d => d.target.y);

    // Nodes
    const node = svg.selectAll(".node")
                    .data(treeData.descendants())
                    .enter()
                    .append("g")
                    .attr("class", "node")
                    .attr("transform", d => `translate(${d.x},${d.y})`);

    node.append("circle").attr("r", 25);

    node.append("text")
        .attr("dy", -2)
        .attr("text-anchor", "middle")
        .text(d => `${d.data.string}`); 

    node.append("text")
        .attr("dy", 10) 
        .attr("text-anchor", "middle")
        .text(d => `(${d.data.state})`);
}