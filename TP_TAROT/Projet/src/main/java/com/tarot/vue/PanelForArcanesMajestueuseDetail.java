package com.tarot.vue;

import com.tarot.model.ArcanesMajestueuses;

import com.tarot.model.Card;

import javax.swing.*;
import java.awt.*;

public class PanelForArcanesMajestueuseDetail extends AbstractPanelForArcanesType {



    private final JPanel panelPlanet = new JPanel(new GridLayout(1,1));
        private final JLabel planet = new JLabel();
        private final JButton iconSetPlanet = new JButton();


    private final JComboBox comboBoxPlanet = new JComboBox();
        String planetModel[] = {"Choisissez...", "Terre", "Mars", "Uranus", "Jupiter", "Mercure", "Venus", "Saturne", "Neptune"};
        private final DefaultComboBoxModel modelPlanet = new DefaultComboBoxModel(planetModel);


    GridLayout gbL = new GridLayout(3,1);


    /**
     * Constructor
     * @param c the currently card detailPanel shows
     */
    public PanelForArcanesMajestueuseDetail(ArcanesMajestueuses c)
    {
        super();

        initComponent();
        this.currentCard = c;
        this.name.setText(c.getNom());
        this.number.setText(c.getNumber());
        this.planet.setText(c.getPlanet());
        setStyleComponent();
        fillHashMap();


    }


    /**
     * init Component and add button to a listener and the correct hashmap
     */
    public void initComponent() {


        super.initComponent();
        this.setLayout(gbL);
        this.setOpaque(false);
        this.setBackground(new Color(3,3,32));
        this.panelPlanet.setName("panelPlanet");
        this.comboBoxPlanet.setModel(this.modelPlanet);
        this.setPreferredSize(new Dimension(100,30));
        this.iconSetPlanet.setIcon(new ImageIcon(getClass().getResource("/images/").getPath()+"edit.png"));
        this.panelPlanet.add(this.planet);
        VueTest.mapBtnHoverAction.put(this.planet,this);
        this.planet.addMouseListener(btnAct);
        this.panelPlanet.add(this.iconSetPlanet);
        VueTest.mapBtnHoverAction.put(this.iconSetPlanet,this);
        VueTest.mapBtnClickAction.put(this.iconSetPlanet,this);
        this.iconSetPlanet.addMouseListener(btnAct);
        VueTest.mapBtnHoverAction.put(this.comboBoxPlanet,this);
        this.comboBoxPlanet.addMouseListener(btnAct);

        this.panelPlanet.setBackground(new Color(50,51,50));
        this.add(this.panelPlanet);


    }

    /**
     * To set the properties the labels components turn into JtextField or JComboBox
     * a HashMap is created to link JLabel and JTextField/JComboBox that are in the same panel
     * (panel planet)
     * after a super one
     */
    public void fillHashMap()
    {
        super.fillHashMap();
        this.fieldAndHisKey.put(this.panelPlanet.getName(),this.comboBoxPlanet);
        this.labelAndHisKey.put(this.panelPlanet.getName(),this.planet);

    }

    /**
     * set differents style to the components after a super one
     */
    public void setStyleComponent() {

        super.setStyleComponent();
        this.planet.setForeground(Color.WHITE);

    }


    /**
     *
     * @return the new card that will replace the old one in the collection card
     */
    @Override
    public Card modifyCardAfterValidForm() {
        return new ArcanesMajestueuses(this.number.getText(), this.currentCard.getPicture(), this.name.getText(), this.planet.getText());
    }


    /**
     * reset the state of panel planet
     */
    public void resetStateField()
    {
        super.resetStateField();
        this.panelPlanet.remove(0);
        this.panelPlanet.add(this.planet,0);
        this.panelPlanet.getComponent(0).setVisible(true);
        ((JButton)this.panelPlanet.getComponent(1)).setIcon((new ImageIcon(getClass().getResource("/images/").getPath() + "edit.png")));

    }
}
